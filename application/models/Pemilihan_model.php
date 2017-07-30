<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pemilihan_model extends CI_Model
{	
    function __construct()
    {
         $this->load->library('m_db');
    }
    
    function pengguna_data($where=array(),$order="username ASC")
    {
		$d=$this->m_db->get_data('pengguna',$where,$order);
		return $d;
	}

	function pemilihan_gedung_data($where=array(),$order="id_gedung ASC")
    {
		$d=$this->m_db->get_data('pemilihan_gedung',$where,$order);
		return $d;
	}
	
	function pemilihan_gedung_info($id_pemilihan_gedung,$output)
	{
		$s=array(
		'id_pemilihan_gedung'=>$id_pemilihan_gedung,
		);
		//SELECT g.nama_gedung FROM (pemilihan_gedung_info_gedung pg LEFT JOIN gedung j ON pg.id_gedung = g.id_gedung) where id_gedung='$idg'
		$item=$this->m_db->get_row('pemilihan_gedung',$s,$output);
		return $item;
	}
	
	function pemilihan_gedung_add($id_gedung,$id_jenis_gedung,$nama_pemilihan,$tahun,$kuota)
	{
		$d=array(
		'id_gedung'=>$id_gedung,
		'id_jenis_gedung'=>$id_jenis_gedung,
		'nama_pemilihan'=>$nama_pemilihan,
		'tahun'=>$tahun,
		'kuota'=>$kuota,
		);
		if($this->m_db->add_row('pemilihan_gedung',$d)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function pemilihan_gedung_edit($id_pemilihan_gedung,$id_gedung,$id_jenis_gedung,$nama_pemilihan,$tahun,$kuota)
	{
		$s=array(
		'id_pemilihan_gedung'=>$id_pemilihan_gedung,
		);
		$d=array(
		'id_gedung'=>$id_gedung,
		'id_jenis_gedung'=>$id_jenis_gedung,
		'nama_pemilihan'=>$nama_pemilihan,
		'tahun'=>$tahun,
		'kuota'=>$kuota,
		);
		if($this->m_db->edit_row('pemilihan_gedung',$d,$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	
	function pemilihan_gedung_delete($id_pemilihan_gedung)
	{
		$s=array(
		'id_pemilihan_gedung'=>$id_pemilihan_gedung,
		);		
		if($this->m_db->delete_row('pemilihan_gedung',$s)==TRUE)
		{
			return true;
		}else{
			return false;
		}
	}
	

	
	function peserta_add($id_penyewa,$id_pemilihan_gedung,$kriteriaData=array())
	{
		$s=array(
        'id_penyewa'=>$id_penyewa,
        );
        if($this->m_db->is_bof('penyewa',$s)==TRUE)
        {
        	if(!empty($kriteriaData))
        	{
				$d=array(
				'id_pemilihan_gedung'=>$id_pemilihan_gedung,
				'id_penyewa'=>$id_penyewa,
				);
				if($this->m_db->add_row('pemilih_penyewa',$d)==TRUE)
				{
					$id_pemilih_penyewa=$this->m_db->last_insert_id();
					foreach($kriteriaData as $rK=>$rV)
					{
						$d2=array(
						'id_pemilih_penyewa'=>$id_pemilih_penyewa,
						'id_kriteria'=>$rK,
						'nilai_id'=>$rV,
						);
						$this->m_db->add_row('peserta_nilai',$d2);
					}
					return true;
				}else{
					//echo "GAGAL TAMBAH PEMILIH PENYEWA";
					return false;
				}
			}else{
				//echo "DATA KRITERIA TAK ADA";
				return false;
			}		
		}else{
			//echo "PENYEWA TIDAK ADA";
			return false;
		}
	}
	
	function peserta_edit($id_penyewa,$id_pemilihan_gedung,$kriteriaData=array())
	{
		$s=array(
         'id_penyewa'=>$id_penyewa,
        );
        if($this->m_db->is_bof('penyewa',$s)==FALSE)
        {
        	$speserta=array(
        	 'id_penyewa'=>$id_penyewa,
        	);
        	
        	if($this->m_db->is_bof('pemilih_penyewa',$speserta)==FALSE)
        	{
							
        	if(!empty($kriteriaData))
        	{
				$d=array(
				'id_pemilihan_gedung'=>$id_pemilihan_gedung,
				'id_penyewa'=>$id_penyewa,
				);
				if($this->m_db->edit_row('pemilih_penyewa',$d,$speserta)==TRUE)
				{
					//$pesertaID=$this->m_db->last_insert_id();
					foreach($kriteriaData as $rK=>$rV)
					{
						$s2=array(
						'id_penyewa'=>$id_penyewa,
						'id_kriteria'=>$rK,
						);
						if($this->m_db->is_bof('peserta_nilai',$s2)==TRUE)
						{
							$d2=array(
							'id_penyewa'=>$id_penyewa,
							'id_kriteria'=>$rK,
							'nilai_id'=>$rV,
							);
							$this->m_db->add_row('peserta_nilai',$d2);
						}else{
							$d2=array(												
							'nilai_id'=>$rV,
							);
							$this->m_db->edit_row('peserta_nilai',$d2,$s2);
						}						
					}
					return true;
				}else{
					//echo "GAGAL UBAH PESERTA";
					return false;
				}
			}else{
				//echo "DATA KRITERIA TAK ADA";
				return false;
			}	
			
			}else{
				return false;
			}	
		}else{
			//echo "SISWA TIDAK ADA";
			return false;
		}
	}
	
	function peserta_delete($id_pemilih_penyewa)
	{
		$id_penyewa=field_value('pemilih_penyewa','id_pemilih_penyewa',$id_pemilih_penyewa,'id_penyewa');
		$s=array(
         'id_penyewa'=>$id_penyewa,
        );
        if($this->m_db->is_bof('penyewa',$s)==FALSE)
        {
        	$speserta=array(
        	'id_pemilih_penyewa'=>$id_pemilih_penyewa,
        	);
        	
        	if($this->m_db->is_bof('pemilih_penyewa',$speserta)==FALSE)
        	{
        		if($this->m_db->delete_row('pemilih_penyewa',$speserta)==TRUE)
        		{
        			$this->m_db->delete_row('peserta_nilai',$speserta);
					return true;
				}else{
					return false;
				}
        		
        	}else{
				return false;
			}
        }else{
			return false;
		}
	}
	
	function peserta_delete_admin($id_pemilih_penyewa)
	{
		$id_penyewa=field_value('pemilih_penyewa','id_pemilih_penyewa',$id_pemilih_penyewa,'id_penyewa');		
    	$speserta=array(
    	'id_pemilih_penyewa'=>$id_pemilih_penyewa,
    	);
    	
    	if($this->m_db->is_bof('pemilih_penyewa',$speserta)==FALSE)
    	{
    		if($this->m_db->delete_row('pemilih_penyewa',$speserta)==TRUE)
    		{
    			$this->m_db->delete_row('peserta_nilai',$speserta);
				return true;
			}else{
				return false;
			}
    		
    	}else{
			return false;
		}
	}
	
	function proseshitung($IDpemilihan_gedung)
	{
		$s=array(
		'id_pemilihan_gedung'=>$IDpemilihan_gedung,
		);
		$dKriteria=$this->mod_kriteria->kriteria_data();
		if($this->m_db->is_bof('pemilihan_gedung',$s)==FALSE)
		{
			$dPeserta=$this->m_db->get_data('pemilih_penyewa',$s);
			if(!empty($dPeserta))
			{
				
				foreach($dPeserta as $rPeserta)
				{
					$IDpemilih_penyewa=$rPeserta->id_pemilih_penyewa;
					$IDpenyewa=$rPeserta->id_penyewa;
					$KTP=field_value('penyewa','id_penyewa',$IDpenyewa,'KTP');
					$nama=field_value('penyewa','id_penyewa',$IDpenyewa,'nama_penyewa');			
					if(!empty($dKriteria))
					{
						$total=0;
						foreach($dKriteria as $rKriteria)
						{						
							$id_kriteria=$rKriteria->id_kriteria;
							$subkriteria=peserta_nilai($IDpemilih_penyewa,$id_kriteria);
							$nilaiID=field_value('subkriteria','subkriteria_id',$subkriteria,'nilai_id');
							$nilai=field_value('nilai_kategori','nilai_id',$nilaiID,'nama_nilai');
							$prioritas=ambil_prioritas($IDpemilihan_gedung,$subkriteria);
							$total+=$prioritas;							
						}						
					}
					
					$shasil=array(
					'id_pemilih_penyewa'=>$IDpemilih_penyewa,
					'id_pemilihan_gedung'=>$IDpemilihan_gedung,
					);
					$dhasil=array(
					'total'=>$total,
					);
					$this->m_db->edit_row('pemilih_penyewa',$dhasil,$shasil);
					$kuota=$this->pemilihan_gedung_info($IDpemilihan_gedung,'kuota');
			
					$dPH=$this->m_db->get_data('pemilih_penyewa',$s,'total DESC');
					$rank=0;
					foreach($dPH as $rPH)
					{
						$rank+=1;
						$d=array();
						if($rank <= $kuota)
						{
							$d=array(
							'status'=>'Layak Sewa',
							);
						}else{
							$d=array(
							'status'=>'Tidak Layak Sewa',
							);
						}
						$this->m_db->edit_row('pemilih_penyewa',$d,array('id_pemilih_penyewa'=>$rPH->id_pemilih_penyewa));
					}
					
					return true;
				}								
			}else{
				return false;
			}
			
		}else{
			return false;
		}
	}
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Donwload extends CI_Controller
{
    public function download_berkas(){				
		force_download('konten/dokumen/a.pdf',NULL);
	}	
    
}

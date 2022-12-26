function simpan_pengguna()
{
$config['upload_path'] = './assets/images/'; //path folder
$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; //type yang dapat diakses bisa anda sesuaikan
$config['encrypt_name'] = TRUE; //nama yang terupload nantinya

$this->upload->initialize($config);
if (!empty($_FILES['filefoto']['name'])) {
if ($this->upload->do_upload('filefoto')) {
$gbr = $this->upload->data();
//Compress Image
$config['image_library'] = 'gd2';
$config['source_image'] = './assets/images/' . $gbr['file_name'];
$config['create_thumb'] = FALSE;
$config['maintain_ratio'] = FALSE;
$config['quality'] = '60%';
$config['width'] = 300;
$config['height'] = 300;
$config['new_image'] = './assets/images/' . $gbr['file_name'];
$this->load->library('image_lib', $config);
$this->image_lib->resize();

$gambar = $gbr['file_name'];
$nama = $this->input->post('xnama');
$jenkel = $this->input->post('xjenkel');
$username = $this->input->post('xusername');
$password = $this->input->post('xpassword');
$konfirm_password = $this->input->post('xpassword2');
$email = $this->input->post('xemail');
$nohp = $this->input->post('xkontak');
$level = $this->input->post('xlevel');
if ($password <> $konfirm_password) {
    echo $this->session->set_flashdata('msg', 'error');
    redirect('admin/pengguna');
    } else {
    $this->m_pengguna->simpan_pengguna($nama, $jenkel, $username, $password, $email, $nohp, $level, $gambar);
    echo $this->session->set_flashdata('msg', 'success');
    redirect('admin/pengguna');
    }
    } else {
    echo $this->session->set_flashdata('msg', 'warning');
    redirect('admin/pengguna');
    }
    } else {
    $nama = $this->input->post('xnama');
    $jenkel = $this->input->post('xjenkel');
    $username = $this->input->post('xusername');
    $password = $this->input->post('xpassword');
    $konfirm_password = $this->input->post('xpassword2');
    $email = $this->input->post('xemail');
    $nohp = $this->input->post('xkontak');
    $level = $this->input->post('xlevel');
    if ($password <> $konfirm_password) {
        echo $this->session->set_flashdata('msg', 'error');
        redirect('admin/pengguna');
        } else {
        $this->m_pengguna->simpan_pengguna_tanpa_gambar($nama, $jenkel, $username, $password, $email, $nohp, $level);
        echo $this->session->set_flashdata('msg', 'success');
        redirect('admin/pengguna');
        }
        }
        }
<?php
if (! defined('BASEPATH')) exit('No direct script access allowed');
class Book_management extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('admin_model');
        $this->load->library('pagination');
        $this->load->library('form_validation');
    }


    //添加图书
    public function add_book(){
        $this->load->view('add_books');
    }

    //显示书库
    public function show_books(){
        $page_size = 7;
        $page = $this->uri->segment(4);
        if($page == Null){
            $page = 1;
        }
        $offset = ($page - 1) * $page_size;
        $pageall = $this->admin_model->get_all();
        $config['base_url'] = '/Admin/show_books/page/';
        $config['total_rows'] = $pageall['total'];
        $config['per_page'] = $page_size;
        $config['use_page_numbers'] = true;//URL中的数字显示第几页，否则，显示到达第几条
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';

        $data['book'] = $this->admin_model->book_select_all($page_size,$offset);
        $this->pagination->initialize($config);
        $data['link'] = $this->pagination->create_links();
        $this->load->view('show_books',$data);
    }

    //执行添加
    public function add(){
        $this->form_validation->set_rules('barcode','Barcode','numeric');
        $this->form_validation->set_rules('bookname','Bookname','max_length[8]');
        $this->form_validation->set_rules('author','Author','max_length[10]');
        $this->form_validation->set_rules('press','Press','min_length[7]|max_length[12]');
        $this->form_validation->set_rules('publish_date','Publish_date','alpha_dash|numeric|min_length[10]');
        $this->form_validation->set_rules('content','Content','max_length[120]');

        if($this->form_validation->run() == false){
            echo validation_errors();
        }else{
            $barcode = $this->input->post('barcode',true);
            $bookname = $this->input->post('bookname',true);
            $author = $this->input->post('author',true);
            $press = $this->input->post('press',true);
            $publish_date = $this->input->post('date',true);
            $content = $this->input->post('content',true);
            $data = array(
                'barcode' => $barcode,
                'bookname' => $bookname,
                'author' => $author,
                'press' => $press,
                'publish_date' => $publish_date,
                'content' => $content
            );
            $add_book = $this->admin_model->add_book($data);
            if ($add_book) {
                echo json_encode(array('code' => 1, 'message' => 'Add successfull!'));
            }else {
                echo json_encode(array('code' => 0, 'message' => 'Add failure'));
            }
        }
    }

    //修改图书
    public function change_book(){
        $barcode = $this->input->get('barcode',Null);
        $bookname = $this->input->get('bookname',Null);
        $author = $this->input->get('author',Null);
        $press = $this->input->get('press',Null);
        $publish_date = $this->input->get('publish_date',Null);
        $book = $this->admin_model->get($barcode);
        $content = $book['content'];
        // var_dump($content);
        // var_dump($data['book']);
        $data = array(
            'barcode' => $barcode,
            'bookname' => $bookname,
            'author' => $author,
            'press' => $press,
            'publish_date' => $publish_date,
            'content' => $content
        );

        $this->load->view('change',$data,$content);
    }

    //执行修改
    public function change(){
        $this->form_validation->set_rules('bookname','Bookname','max_length[8]');
        $this->form_validation->set_rules('author','Author','max_length[10]');
        $this->form_validation->set_rules('press','Press','min_length[7]|max_length[12]');
        $this->form_validation->set_rules('publish_date','Publish_date','alpha_dash|numeric|min_length[10]');
        $this->form_validation->set_rules('content','Content','max_length[120]');

        if($this->form_validation->run() == false){
            echo validation_errors();
        }else{
            $barcode = $this->input->post('barcode');
            $bookname = $this->input->post('bookname',true);
            $author = $this->input->post('author',true);
            $press = $this->input->post('press',true);
            $publish_date = $this->input->post('date',true);
            $content = $this->input->post('content',true);
            $data = array(
                'bookname' => $bookname,
                'author' => $author,
                'press' => $press,
                'publish_date' => $publish_date,
                'content' => $content
            );
            $book = $this->admin_model->change_book($data,$barcode);
            if($book) {
                echo json_encode(array('code' => 1, 'message' => 'Modify successfull!'));
            }else{
                echo json_encode(array('code' => 0 , 'message' => 'Modify failure！'));
            }
        }
    }

    //删除图书
    public function delete_book(){
        $barcode = $this->input->get('barcode',Null);
        $bookname = $this->input->get('bookname',Null);
        $author = $this->input->get('author',Null);
        $press = $this->input->get('press',Null);
        $publish_date = $this->input->get('publish_date',Null);
        $data = array(
            'barcode' => $barcode,
            'bookname' => $bookname,
            'author' => $author,
            'press' => $press,
            'publish_date' => $publish_date
        );
        if($this->admin_model->delete_books($data)){
            echo "<script>window.location='/Admin/show_books'</script>";
        }else{
            echo "<script>window.location='/Admin/show_books'</script>";
        }
    }
}
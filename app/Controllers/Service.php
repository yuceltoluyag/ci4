<?php

namespace App\Controllers;

use App\Models\ServiceModel;
use CodeIgniter\Model;
use Config\Services;

class Service extends BaseController
{

    /**
     * @var Model
     */
    protected $model;

    public $viewFolder = "";
    protected $helpers = ["text", "form", "url", "tools"];

    public function __construct()
    {
        $this->viewFolder = "service_v";
        $this->model = new ServiceModel();
    }

    public function index()
    {
        /*
       $viewData["items"] = $this->model
            ->orderBy('id', 'ASC')
            ->findAll();*/
        $keyword = $this->request->getVar('keyword');
        if ($keyword){
            $service = $this->model->search($keyword);
        }else {
            $service = $this->model;
        }

        $viewData['items'] = $service->orderBy('isActive','ASC')->paginate(5,'service');
        $viewData['pager'] = $this->model->pager;
        $viewData['viewFolder'] = $this->viewFolder;
        $viewData['subViewFolder'] = "list";
        return view("$viewData[viewFolder]/$viewData[subViewFolder]/index", $viewData);
    }

    public function new_form()
    {
        // helper([]);
        $viewData['viewFolder'] = $this->viewFolder;
        $viewData['subViewFolder'] = "add";
        $viewData['validation'] = Services::validation();

        return view("$viewData[viewFolder]/$viewData[subViewFolder]/index", $viewData);

    }

    public function save()
    {

        //$validation = Services::validation();

        if (!$this->validate([
            'title' => [
                'rules' => 'required|trim|is_unique[services.title]',
                'errors' => [
                    "required" => "<b>{field}</b> field must be filled",
                    "is_unique" => "<b>{field}</b> field must be unique",
                ],
            ],
            'description' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    "required" => "<b>{field}</b> field must be filled",
                    "min_length" => "Your {field} is too short. You want to get hacked?",
                ],
            ],
            'price' => [
                'rules' => 'required|numeric',
                'errors' => [
                    "required" => "<b>{field}</b> field must be filled",
                    "numeric" => "Your {field} is too short. You want to get hacked?",
                ],
            ],
            'minel' => [
                'rules' => 'max_size[minel,4098]|is_image[minel]|mime_in[minel,image/jpg,image/jpeg,image/png]',
                'errors' => [

                    'max_size' => "File Size Too Large",
                    'is_image' => "Choose an Image File",
                    'mime_in' => "Invalid Format ...",
                ],
            ],
        ])) {
            //return redirect()->to('new_form')->withInput()->with('validation', $validation);
            return redirect()->to('new_form')->withInput();
        }

        $file = $this->request->getFile('minel');
        if ($file->getError() == "4") {
            $newName = "default.jpg";
        } else {
            $newName = $file->getRandomName();
            $file->move('./assets/uploads', $newName);
        }
        $slug = convertToSEO($this->request->getVar('title'));
        $this->model->save([
            'url' => $slug,
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'price' => $this->request->getVar('price'),
            'image' => $newName,
        ]);
        $alert = array(
            "title" => "Transaction Successful",
            "text" => "The registration has been added",
            "type" => "success"
        );

        session()->setFlashdata("alert", $alert);
        return redirect()->to('index');
    }

    public function update_form($id)
    {
        $viewData['item'] = $this->model->find($id);
        $viewData['viewFolder'] = $this->viewFolder;
        $viewData['subViewFolder'] = "update";
        $viewData['validation'] = Services::validation();

        return view("$viewData[viewFolder]/$viewData[subViewFolder]/index", $viewData);

    }

    public function update($id)
    {

        $findServ = $this->model->find($id);

        if ($findServ->title == $this->request->getVar('title')) {
            $rule_title = 'required';

        } else {
            $rule_title = 'required|trim|is_unique[services.title]';
        }

        if (!$this->validate([
            'title' => [
                'rules' => $rule_title,
                'errors' => [
                    "required" => "<b>{field}</b> field must be filled",
                    "is_unique" => "<b>{field}</b> field must be unique",
                ],
            ],
            'description' => [
                'rules' => 'required|min_length[10]',
                'errors' => [
                    "required" => "<b>{field}</b> field must be filled",
                    "min_length" => "Your {field} is too short. You want to get hacked?",
                ],
            ],
            'price' => [
                'rules' => 'required|numeric',
                'errors' => [
                    "required" => "<b>{field}</b> field must be filled",
                    "numeric" => "Your {field} is too short. You want to get hacked?",
                ],
            ],
            'minel' => [
                'rules' => 'max_size[minel,4098]|is_image[minel]|mime_in[minel,image/jpg,image/jpeg,image/png]',
                'errors' => [

                    'max_size' => "File Size Too Large",
                    'is_image' => "Choose an Image File",
                    'mime_in' => "Invalid Format ...",
                ],
            ],
        ])) {
            //return redirect()->to('new_form')->withInput()->with('validation', $validation);
            return redirect()->to('' . $this->request->getVar('slug'))->withInput();

        }

        $file = $this->request->getFile('minel');
        if ($file->getError() == "4") {
            $newName = $this->request->getVar('pictureName');
        } elseif ($findServ->image != 'default.jpg') {
            $newName = $file->getRandomName();
            $file->move('./assets/uploads', $newName);
            $check = './assets/uploads/' . $this->request->getVar('pictureName');
            if (file_exists($check)){
                unlink($check);
            }
        } else {
            $newName = $file->getRandomName();
            $file->move('./assets/uploads', $newName);
        }
        $slug = convertToSEO($this->request->getVar('title'));
        $data = [
            'url' => $slug,
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'price' => $this->request->getVar('price'),
            'image' => $newName,
        ];

        $this->model->update($id, $data);

        $alert = array(
            "title" => "Transaction Successful",
            "text" => "The registration has been updated successfully",
            "type" => "success"
        );

        session()->setFlashdata("alert", $alert);


        return redirect()->to('/service/update_form/' . $findServ->id);

    }

    public function isActiveSetter($id)
    {

        if ($id) {

            $isActive = ($this->request->getPost('data') === "true") ? 1 : 0;

            $data = [
                'isActive' => $isActive,
            ];

            $this->model->update($id, $data);

        }
    }

    public function delete($id)
    {
        $find = $this->model->find($id);

        if ($find) {
            if ($find->image != 'default.jpg') {
                unlink('./assets/uploads/' . $find->image);
            }
            $this->model->delete($id);
            $alert = array(
                "title" => "Transaction Successful",
                "text" => "The registration has been deleted successfully",
                "type" => "success"
            );

            session()->setFlashdata("alert", $alert);

        }
        return redirect()->to('/service');
    }

    //Upload image summernote
    public function upload_image()
    {
        //summernote Test
        $files = $this->request->getFiles();
        foreach ($files as $summerfile) {
            if ($summerfile->isValid() && !$summerfile->hasMoved()) {
                $summerfile->move('./assets/uploads', $summerfile->getName());
                echo base_url() . '/assets/uploads/' . $summerfile->getName();
            }
        }
    }

    public function delete_image()
    {
        //SummerNote Delete Test İnside Editor
        $src = $this->request->getPost('src');
        $name = str_replace(base_url("/assets/uploads/"), '', $src);
        unlink('./assets/uploads/' . $name);

    }

}

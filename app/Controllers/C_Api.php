<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_Api extends BaseController
{
  private $model;

  // constructor
  public function __construct()
  {
    // Load model
    $this->model = new \App\Models\M_Barang();
  }

  public function getBarang()
  {
    $data = $this->model->findAll();
    return $this->response->setJSON($data);
  }


  public function addStock($id, $qty)
  {
    $data = $this->model->find($id);

    $this->model->update($id, [
      'stok' => $data['stok'] + $qty
    ]);
  }

  public function reduceStock($id)
  {
    $data = $this->model->find($id);

    $this->model->update($id, [
      'stok' => $data['stok'] - 1
    ]);
  }
}

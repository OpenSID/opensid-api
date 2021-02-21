<?php

namespace App\Http\Controllers;

use App\Http\Repository\BantuanPesertaEntity;
use App\Http\Transformers\BantuanPesertaTransformer;

class BantuanController extends Controller
{
    /** @var BantuanPesertaEntity */
    protected $bantuan;

    public function __construct(BantuanPesertaEntity $bantuan)
    {
        $this->bantuan = $bantuan;
    }

    public function index()
    {
        return $this->fractal($this->bantuan->get(), new BantuanPesertaTransformer(), 'bantuan peserta');
    }

    public function show(int $id)
    {
        return $this->fractal($this->bantuan->find($id), new BantuanPesertaTransformer(), 'bantuan peserta');
    }
}

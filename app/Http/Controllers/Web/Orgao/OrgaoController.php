<?php

namespace App\Http\Controllers\Web\Orgao;

use App\Http\Controllers\Controller;
use App\Models\Orgao as ModelsOrgao;

class OrgaoController extends Controller
{
    public function porPraca(int $cod_local)
    {
        $orgaos = ModelsOrgao::query()
            ->select(['cod_orgao', 'nome'])
            ->where('cod_local', $cod_local)
            ->where('inativo', 0)
            ->orderBy('cod_orgao', 'asc')
            ->get();

        return response()->json($orgaos, 200);
    }
}

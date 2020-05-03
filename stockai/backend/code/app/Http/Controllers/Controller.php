<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Retorna uma mensagem de erro em formato padronizado.
     * @param string $message
     * @param int $code
     * @param \Exception|null $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error($message = '', $code = 500, \Exception $e = null)
    {
        $response = [ 'error' => true ];
        $response['message'] = [];

        if (is_string($message)) {
            $message = ['error' => [$message ?: 'Ocorreu um erro na sua solicitação.']];
        }

        $response['message'] = [ $message ];

        if ($e) {
            $error =  [
                'message' => $e->getMessage(),
                'code'    => $e->getCode(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ];

            if (env('APP_ENV') == 'local') {
                $response['trace'] = $error;
            }

            Log::error($error);
        }

        return response()->json($response, $code);

    }

    /**
     * Retorna uma mensagem de sucesso em formato padronizado.
     * @param null $data
     * @param string $message
     * @param bool $success
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data = null, $message = '', $success = true)
    {
        return response()->json(
            [
                'success' => $success,
                'data'    => $data ?: [],
                'message' => $message ?: ''
            ]
        );

    }

    protected function createTempFile($content = null, $extension = null)
    {
        $filename = rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . uniqid('easymed_emr', true);

        if (null !== $extension) {
            $filename .= '.'.$extension;
        }

        if (null !== $content) {
            file_put_contents($filename, $content);
        }

        $this->temporaryFiles[] = $filename;

        return $filename;
    }

    /**
     * @param null $search
     * @return array
     */
    protected function filters($search)
    {
        $dados = [];

        if (!is_null($search)) {
            $parametros = explode(';', $search);
            foreach ($parametros as $parametro) {
                if ($parametro != '') {
                    $result = explode(':', $parametro);
                    $dados[$result[0]] = $result[1];
                }
            }
        }
        return $dados;
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 04/07/18
 * Time: 11:05
 */

@session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/Users/ModelUser.php";

class ImageUploads
{
    public function imageUpload()
    {
        // verifica se foi enviado um img_user
        if ( isset( $_FILES[ 'img_user' ][ 'name' ] ) && $_FILES[ 'img_user' ][ 'error' ] == 0 ) {

            $tmpFile = $_FILES[ 'img_user' ][ 'tmp_name' ];
            $nameFile = $_FILES[ 'img_user' ][ 'name' ];

            // Pega a extensão
            $extension = pathinfo ( $nameFile, PATHINFO_EXTENSION );

            // Converte a extensão para minúsculo
            $extension = strtolower ( $extension );

            // Somente imagens, .jpg;.jpeg;.gif;.png
            if ( strstr ( '.jpg;.jpeg;.gif;.png', $extension ) ) {
                // Cria um nome único para esta imagem
                // Evita que duplique as imagens no servidor.
                // Evita nomes com acentos, espaços e caracteres não alfanuméricos
                $newName = uniqid ( time () ) . '.' . $extension;

                // Concatena a pasta com o nome
                $destiny = $_SERVER['DOCUMENT_ROOT'] . '/assets/images/users/' . $newName;

                // tenta mover o img_user para o destino
                if ( move_uploaded_file ( $tmpFile, $destiny ) ) {

                    $arrayReturn = [
                        'sucess' => true,
                        'messege' => 'img_user gravado com sucesso!',
                        'file_name' => $newName
                    ];
                }
                else {
                    $arrayReturn = [
                        'sucess' => false,
                        'messege' => 'Erro ao salvar o img_user. Aparentemente você não tem permissão de escrita.',
                    ];
                }
            }
            else {
                $arrayReturn = [
                    'sucess' => false,
                    'messege' => 'Você poderá enviar apenas img_users "*.jpg;*.jpeg;*.gif;*.png"',
                ];
            }
        }
        else {
            $arrayReturn = [
                'sucess' => false,
                'messege' => 'Você não enviou nenhum img_user!',
            ];
        }

        return $arrayReturn;
    }
}
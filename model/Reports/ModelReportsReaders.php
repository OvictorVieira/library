<?php
/**
 * Created by PhpStorm.
 * Reader: victor
 * Date: 08/06/18
 * Time: 09:56
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/incConex/IncConexDataBase.php";

class ModelReportsReaders
{

    /**
     * @return array|string
     */
    public function getReportReares()
    {

        $sql = "SELECT 
                    rdr.name as readerName,
                    rdr.cpf as readerCpf,
                    count(loan.reader_id) as qtd_rdr_loan
                FROM loans as loan
                JOIN readers rdr on loan.reader_id = rdr.id
                
                GROUP BY rdr.id ORDER BY qtd_rdr_loan DESC";

        $conex = new IncConexDataBase();

        $resultSelect = mysqli_query($conex->conectDatabase(), $sql);

        $reportsReader = [];

        if($resultSelect) {

            while($arrayReportsReaders = mysqli_fetch_assoc($resultSelect)) {

                $reportsReader[] = [
                    'reader_name' => $arrayReportsReaders['readerName'],
                    'reader_cpf' => $arrayReportsReaders['readerCpf'],
                    'qtd_rdr_loan' => $arrayReportsReaders['qtd_rdr_loan']
                ];

            }

        }

        return $reportsReader;
    }
}
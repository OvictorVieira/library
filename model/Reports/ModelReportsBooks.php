<?php
/**
 * Created by PhpStorm.
 * Reader: victor
 * Date: 08/06/18
 * Time: 09:56
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/incConex/IncConexDataBase.php";

class ModelReportsBooks
{
    /**
     * @return array|string
     */
    public function getReportBook()
    {

        $sql = "SELECT 
                bk.id as bookId,
                bk.title as bookTitle,
                bk.publication_date,
                aut.id as authorId,
                aut.name as authorName,
                gnr.id as genreId,
                gnr.name as genreName,
                pbl.id as publisherId,
                pbl.name as publisherName,
                count(bhl.book_id) as qtd
            FROM books_has_loans as bhl
            JOIN books bk on bk.id = bhl.book_id
            JOIN authors as aut on bk.author_id = aut.id
            JOIN publishers pbl on bk.publisher_id = pbl.id
            JOIN genres gnr on bk.genre_id = gnr.id
            
            GROUP BY bk.id ORDER BY qtd DESC";

        $conex = new IncConexDataBase();

        $resultSelect = mysqli_query($conex->conectDatabase(), $sql);

        $reportsBook = [];

        if($resultSelect) {

            while($arrayReportsBook = mysqli_fetch_assoc($resultSelect)) {

                $reportsBook[] = [
                    'book_id' => $arrayReportsBook['bookId'],
                    'book_title' => $arrayReportsBook['bookTitle'],
                    'publication_date' => $arrayReportsBook['publication_date'],
                    'author_id' => $arrayReportsBook['authorId'],
                    'author_name' => $arrayReportsBook['authorName'],
                    'genre_id' => $arrayReportsBook['genreId'],
                    'genre_name' => $arrayReportsBook['genreName'],
                    'publisher_id' => $arrayReportsBook['publisherId'],
                    'publisher_name' => $arrayReportsBook['publisherName'],
                    'qtd' => $arrayReportsBook['qtd']
                ];

            }

        }

        return $reportsBook;
    }
}















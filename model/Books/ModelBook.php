<?php
/**
 * Created by PhpStorm.
 * Reader: victor
 * Date: 08/06/18
 * Time: 09:56
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/incConex/IncConexDataBase.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/class/Book.php";

class ModelBook {

    /**
     * @param $id
     * @return array|null|string
     */
    public function getBook($id)
    {

        $sql = "SELECT bk.id as bookId, bk.title as bookTitle, bk.publication_date, aut.id as authorId, aut.name as authorName, gnr.id as genreId, gnr.name as genreName, pbl.id as publisherId, pbl.name as publisherName FROM books as bk 
            JOIN authors as aut on bk.author_id = aut.id
            JOIN publishers pbl on bk.publisher_id = pbl.id
            JOIN genres gnr on bk.genre_id = gnr.id WHERE id = '$id'";

        $conex = new IncConexDataBase();
        $resultQuery = mysqli_query($conex->conectDatabase(), $sql);

        $book = new Book();

        if(mysqli_num_rows($resultQuery) == 1) {

            $resultBook = mysqli_fetch_array($resultQuery);

            $book->setTitle($resultBook['bookTitle']);
            $book->setId($resultBook['bookId']);
            $book->setPublicationDate($resultBook['publication_date']);
            $book->setAuthorId($resultBook['authorId']);
            $book->setAuthorName($resultBook['authorName']);
            $book->setGenreId($resultBook['genreId']);
            $book->setGenreName($resultBook['genreName']);
            $book->setPublisherId($resultBook['publisher_id']);
            $book->setPublisherName($resultBook['publisherName']);
        }

        return $book;
    }

    /**
     * @param $name
     * @param $publicationDate
     * @param $genre
     * @param $author
     * @param $publisher
     * @return bool|mysqli_result
     */
    public function setBook($name, $publicationDate, $genre, $author, $publisher)
    {

        $publicationDate = date('Y-m-d', strtotime($publicationDate));

        $sql = "INSERT INTO books (title, publication_date, genre_id, author_id, publisher_id) VALUES ('%s', '%s', '%s', '%s', '%s')";
        $createBook = sprintf($sql,$name, $publicationDate, $genre, $author, $publisher);

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $createBook);
    }

    /**
     * @param $id
     * @param $title
     * @param $publicationDate
     * @param $genre
     * @param $author
     * @param $publisher
     * @return bool|mysqli_result
     */
    public function updateBook($id, $title, $publicationDate, $genre, $author, $publisher)
    {

        $publicationDate = date('Y-m-d', strtotime($publicationDate));

        $sql = "UPDATE books SET title = '%s', publication_date = '%s', author_id = '%s', genre_id = '%s', publisher_id = '%s'  WHERE id = '%d'";
        $updateBook = sprintf($sql, $title, $publicationDate, $author, $genre, $publisher, $id);

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $updateBook);
    }

    /**
     * @param $id
     * @return bool|mysqli_result
     */
    public function deleteBook($id)
    {
        $sql = "DELETE FROM books WHERE id = '%d'";
        $deleteBook = sprintf($sql,$id);

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $deleteBook);
    }

    /**
     * @return bool|mysqli_result
     */
    public function getAllBook()
    {
        $sql = "SELECT bk.id as bookId, bk.title as bookTitle, bk.publication_date, aut.id as authorId, aut.name as authorName, gnr.id as genreId, gnr.name as genreName, pbl.id as publisherId, pbl.name as publisherName FROM books as bk 
            JOIN authors as aut on bk.author_id = aut.id
            JOIN publishers pbl on bk.publisher_id = pbl.id
            JOIN genres gnr on bk.genre_id = gnr.id ORDER BY bk.title";

        $conex = new IncConexDataBase();
        $queryExec = mysqli_query($conex->conectDatabase(), $sql);

        $arrayBooks = [];

        if($queryExec) {

            while ($listBooks = mysqli_fetch_assoc($queryExec)) {

                $book = new Book();

                $book->setTitle($listBooks['bookTitle']);
                $book->setId($listBooks['bookId']);
                $book->setPublicationDate($listBooks['publication_date']);
                $book->setAuthorId($listBooks['authorId']);
                $book->setAuthorName($listBooks['authorName']);
                $book->setGenreId($listBooks['genreId']);
                $book->setGenreName($listBooks['genreName']);
                $book->setPublisherId($listBooks['publisherId']);
                $book->setPublisherName($listBooks['publisherName']);
                $arrayBooks[] = $book;
            }
        }

        return $arrayBooks;
    }
}
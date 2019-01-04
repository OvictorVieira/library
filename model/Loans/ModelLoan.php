<?php
/**
 * Created by PhpStorm.
 * Reader: victor
 * Date: 08/06/18
 * Time: 09:56
 */

require_once $_SERVER['DOCUMENT_ROOT'] . "/model/incConex/IncConexDataBase.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/class/Loan.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/class/User.php";

class ModelLoan
{
    /**
     * @param $id
     * @return Loan
     */
    public function getLoan($id)
    {
        $sql = "SELECT loan.id as loanId, loan_date, return_date, status_id, usr.id as userId ,usr.name as nameUser, rdr.id as readerId , rdr.name as readerName,
                cancellation_date, date_returned, bhl.book_id bookBhlId, bk.title as bkTitle
                FROM loans as loan JOIN users usr on loan.user_id = usr.id
                JOIN readers rdr on loan.reader_id = rdr.id
                JOIN status sts on loan.status_id = sts.id
                JOIN books_has_loans bhl on loan.id = bhl.loan_id
                JOIN books bk on bhl.book_id = bk.id
                WHERE loan.id = '$id'";

        $conex = new IncConexDataBase();
        $resultQuery = mysqli_query($conex->conectDatabase(), $sql);

        $loan = new Loan();

        if(mysqli_num_rows($resultQuery) == 1) {

            $resultLoan = mysqli_fetch_array($resultQuery);

            $loan->setId($resultLoan['loanId']);
            $loan->setLoanDate($resultLoan['loan_date']);
            $loan->setReturnDate($resultLoan['return_date']);
            $loan->setStatusId($resultLoan['status_id']);
            $loan->setUserId($resultLoan['userId']);
            $loan->setUserName($resultLoan['nameUser']);
            $loan->setReaderId($resultLoan['readerId']);
            $loan->setReaderName($resultLoan['readerName']);
            $loan->setBookHasLoansId($resultLoan['bookBhlId']);
            $loan->setBookTitle($resultLoan['bkTitle']);
            $loan->setCancellationDate($resultLoan['readerName']);
            $loan->setDateReturned($resultLoan['readerName']);

        }

        return $loan;
    }

    /**
     * @param $bookId
     * @param $readerId
     * @param $userId
     * @param $returnDate
     * @return bool
     */
    public function setLoan($bookId, $readerId, $userEmail, $returnDate)
    {
        $returnDate = date('Y-m-d', strtotime($returnDate));

        $user = new ModelUser();

        // Retorna um Objeto Usuário
        $userId = $user->getUser($userEmail)->getId();

        $sql = "INSERT INTO loans (loan_date, return_date, status_id, user_id, reader_id) VALUES ('%s','%s','%s','%s','%s')";
        $createLoan = sprintf($sql, date('Y-m-d'), $returnDate, '1', $userId, $readerId);

        $conex = new IncConexDataBase();

        if(mysqli_query($conex->conectDatabase(), $createLoan)) {

            if( $this->setBookHasLoans($bookId, $conex->returnLastId() ) ) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $bookId
     * @param $loanId
     * @return bool|mysqli_result
     */
    public function setBookHasLoans($bookId, $loanId)
    {
        $sql = "INSERT INTO books_has_loans (book_id, loan_id) VALUES ('%s','%s')";
        $createBookLoan = sprintf($sql, $bookId, $loanId);

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $createBookLoan);
    }

    /**
     * @param $id
     * @param $statusId
     * @return bool|mysqli_result
     */
    public function updateLoan($id, $statusId)
    {
        $cancellationDate = date('Y-m-d');
        $dateReturned = date('Y-m-d');

        // status Cancelado
        if($statusId == 2) {
            $sql = "UPDATE loans SET status_id = '%s', cancellation_date = '%s', date_returned = '%s' WHERE id = '%d'";
            $updateLoan = sprintf($sql, $statusId, $cancellationDate, $dateReturned, $id);
        }

        // status Devolvido
        if($statusId == 3) {
            $sql = "UPDATE loans SET status_id = '%s', date_returned = '%s' WHERE id = '%d'";
            $updateLoan = sprintf($sql, $statusId, $dateReturned, $id);
        }

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $updateLoan);
    }

    /**
     * @param $id
     * @return bool|mysqli_result
     */
    public function deleteLoan($id)
    {
        $sql = "DELETE FROM loans WHERE id = %d";
        $deleteLoan = sprintf($sql,$id);

        $conex = new IncConexDataBase();

        return mysqli_query($conex->conectDatabase(), $deleteLoan);
    }

    /**
     * @return array
     */
    public function getAllLoans()
    {
        $sql = "SELECT loan.id as loanId, loan_date, return_date, status_id, usr.id as userId ,usr.name as nameUser, rdr.id as readerId , rdr.name as readerName,
                cancellation_date, date_returned, bhl.book_id bookBhlId, bk.title as bkTitle
                FROM loans as loan JOIN users usr on loan.user_id = usr.id
                JOIN readers rdr on loan.reader_id = rdr.id
                JOIN status sts on loan.status_id = sts.id
                JOIN books_has_loans bhl on loan.id = bhl.loan_id
                JOIN books bk on bhl.book_id = bk.id";

        $conex = new IncConexDataBase();

        $queryExec = mysqli_query($conex->conectDatabase(), $sql);

        $arrayLoans = [];

        if($queryExec) {

            while ($listLoans = mysqli_fetch_assoc($queryExec)) {

                $loan = new Loan();

                $loan->setId($listLoans['loanId']);
                $loan->setLoanDate($listLoans['loan_date']);
                $loan->setReturnDate($listLoans['return_date']);
                $loan->setStatusId($listLoans['status_id']);
                $loan->setUserId($listLoans['userId']);
                $loan->setUserName($listLoans['nameUser']);
                $loan->setReaderId($listLoans['readerId']);
                $loan->setReaderName($listLoans['readerName']);
                $loan->setBookHasLoansId($listLoans['bookBhlId']);
                $loan->setBookTitle($listLoans['bkTitle']);
                $loan->setCancellationDate($listLoans['cancellation_date']);
                $loan->setDateReturned($listLoans['date_returned']);

                $arrayLoans[] = $loan;
            }
        }

        return $arrayLoans;
    }


    /**
     * @return array of Status
     */
    public function getStatus()
    {
        $sql = "SELECT * FROM status";

        $conex = new IncConexDataBase();

        $resultSelect = mysqli_query($conex->conectDatabase(), $sql);

        $status = [];

        if($resultSelect){

            while($arrayStatus = mysqli_fetch_assoc($resultSelect)) {

                $status[] = [
                    'id' => $arrayStatus['id'],
                    'status' => $arrayStatus['status']
                ];
            }
        }

        return $status;
    }
}
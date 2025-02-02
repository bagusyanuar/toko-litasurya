<?php


namespace App\Commons\Response;


class MetaPagination
{
    /**
     * @var integer $page
     */
    private $page;

    /**
     * @var integer $perPage
     */
    private $perPage;

    /**
     * @var integer $totalRows
     */
    private $totalRows;

    /**
     * MetaPagination constructor.
     * @param int $page
     * @param int $perPage
     * @param int $totalRows
     */
    public function __construct($page = 1, $perPage = 1, $totalRows = 0)
    {
        $this->page = $page;
        $this->perPage = $perPage;
        $this->totalRows = $totalRows;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return MetaPagination
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        return $this->perPage;
    }

    /**
     * @param int $perPage
     * @return MetaPagination
     */
    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalRows()
    {
        return $this->totalRows;
    }

    /**
     * @param int $totalRows
     * @return MetaPagination
     */
    public function setTotalRows($totalRows)
    {
        $this->totalRows = $totalRows;
        return $this;
    }

    public function dehydrate()
    {
        return [
            'total_rows' => $this->getTotalRows(),
            'page' => $this->getPage(),
            'per_page' => $this->getPerPage(),
        ];
    }

}

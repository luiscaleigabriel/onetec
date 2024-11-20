<?php
namespace app\database;

class Pagination
{
    private int $currentPage = 1;
    private int $totalPages;
    private int $linksPerPage = 5;
    private int $itemsPerPage = 10;
    private int $totalItems;
    private string $pageIdentifier = 'page';

    public function setTotalItems(int $totalItems)
    {
        $this->totalItems = $totalItems;
    }

    public function setPageIdentifier(string $identifier)
    {
        $this->pageIdentifier = $identifier;
    }

    public function setItemsPerPage(int $itemsPerPage)
    {
        $this->itemsPerPage = $itemsPerPage;
    }

    public function getTotal()
    {
        return $this->totalItems;
    }

    public function getPerPage()
    {
        return $this->itemsPerPage;
    }

    private function calculations()
    {
        $this->currentPage = $_GET['page'] ?? 1;

        $offset = ($this->currentPage - 1) * $this->itemsPerPage;

        $this->totalPages  = ceil($this->totalItems / $this->itemsPerPage);

        return "limit {$this->itemsPerPage} offset {$offset}";
    }

    public function dump()
    {
        return $this->calculations();
    }

    public function links()
    {
        $links = "<div class='navegation-p'>";

        if ($this->currentPage > 1) {
            $previous = $this->currentPage - 1;
            $linkPage = http_build_query(array_merge($_GET, [$this->pageIdentifier => $previous]));
            $first = http_build_query(array_merge($_GET, [$this->pageIdentifier => 1]));
            $links.= "<a href='?{$linkPage}' class='n-p'> < </a>";
            $links.= "<a href='?{$first}' class='n-p'>Primeira</a>";
        }


        // 3 - 5 =     7 + 5 = 12
        for ($i=$this->currentPage - $this->linksPerPage; $i <=$this->currentPage + $this->linksPerPage ; $i++) {
            if ($i > 0 && $i <= $this->totalPages) {
                $class = $this->currentPage === $i ? 'active' : '';
                $linkPage = http_build_query(array_merge($_GET, [$this->pageIdentifier => $i]));
                $links.="<a href='?{$linkPage}'>{$i}</a>";
            }
        }

        if ($this->currentPage < $this->totalPages) {
            $next = $this->currentPage + 1;
            $linkPage = http_build_query(array_merge($_GET, [$this->pageIdentifier => $next]));
            $last = http_build_query(array_merge($_GET, [$this->pageIdentifier => $this->totalPages]));
            $links.= "<a href='?{$linkPage}' class='n-p'> > </a>";
            $links.= "<a href='?{$last}' class='n-p'>Última</a>";
        }

        $links.="</div>";

        return $links;
    }
}

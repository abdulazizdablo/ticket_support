<?php
 namespace App\Services;
 use Illuminate\Support\Collection;
 class FilterTicketsService{

public function filterTickets( Collection $tickets, string $filter_determinator):Collection{

 return $tickets->sortBy($filter_determinator);



}


 }

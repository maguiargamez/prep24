<?php

namespace App\Http\Traits;

trait WithSelectionItems
{

    public $selectAllItems = false;
    public $selectedItems = [];
 
    public function updatedSelectedItems()
    {        
        if(count($this->selectedItems)<count($this->itemsQuery->pluck('id')->toArray())){
            $this->selectAllItems= false;
        }
        if(count($this->selectedItems)>=count($this->itemsQuery->pluck('id')->toArray())){
            $this->selectAllItems= true;
        }        
    }

    public function updatingSelectAllItems()
    {
        $this->toggleSelectAllItems();
    }
    
    public function toggleSelectAllItems()
    {
        $this->selectAllItems = !$this->selectAllItems;
        if ($this->selectAllItems) {
            $this->selectedItems = $this->itemsQuery->pluck('id')->toArray();
        } else {
            $this->selectedItems = [];
        }
    }
}
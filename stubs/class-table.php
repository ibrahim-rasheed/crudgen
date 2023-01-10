<?php

namespace App\Http\Livewire\Contract;

use App\ContractTypes;
use Livewire\Component;

class Show extends Component
{
    public $contract_types;
    public $pid, $name, $name_dhiv;
    public $updatePost = false;

    protected $listeners = [
        'deletePost' => 'destroy',
        'resetFields' => 'resetFields'
    ];

    // Validation Rules
    protected $rules = [
        'name' => 'required',
        'name_dhiv' => 'required',
    ];

    public function render()
    {
        $this->contract_types = ContractTypes::all();
        return view('livewire.contract.show');
    }


    public function store()
    {

        // Validate Form Request
        $this->validate();

        try {

            // Create Post
            $upsert = ContractTypes::updateOrInsert(
                [
                    'id' => $this->pid
                ],
                [
                    'name' => $this->name,
                    'name_dhiv' => $this->name_dhiv,
                ]
            );

            // check if this is an update or create and add message to variable
            $message = $this->pid > 0 ? 'Updated Successfully!!' : 'Created Successfully!!';

            // Set Flash Message
            session()->flash('success', $message);

            // Reset Form Fields After Creating Post
            $this->resetFields();

            //emit upsert to close bootstrap modal
            $this->emit('upsert');
        } catch (\Exception $e) {
            // Set Flash Message
            session()->flash('error', 'Something goes wrong while creating post!!');

            // Reset Form Fields After Creating Post
            $this->resetFields();
        }
    }

    public function resetFields()
    {
        $this->pid = 0;
        $this->name = '';
        $this->name_dhiv = '';
    }

    public function destroy($id)
    {
        try {
            ContractTypes::find($id)->delete();
            session()->flash('success', "Post Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something went wrong while deleting!!!");
        }
    }


    public function edit($id)
    {
        $item = ContractTypes::findOrFail($id);
        $this->pid = $item->id;
        $this->name = $item->name;
        $this->name_dhiv = $item->name_dhiv;

        $this->updatePost = true;
    }
}

<?php

namespace App\Livewire;

use App\Models\Household;
use Illuminate\Validation\Rule;
use Livewire\Component;

class FormHousehold extends Component
{
    public ?Household $household = null;



    public $id;
    public $nomor_kk;
    public $kepala_keluarga;
    public $email;
    public $no_hp;
    public $alamat;
    public $rt;
    public $rw;

    public function mount(Household $household)
    {
        $this->household = $household;
        $this->id = $household->id;
    }

    protected function rules()
    {
        return [
            "nomor_kk" => ["required", "max:16", Rule::unique("households", "nomor_kk")->ignore($this->household?->id)],
            "kepala_keluarga" => ["required", "string", "max:100"],
            "email" => ["email", "required", Rule::unique("households", "email")->ignore($this->household?->id)],
            "alamat" => ["required", "string", "max:200"],
            "no_hp" => ["required", "max:16"],
            "rt" => ["required", "max:3"],
            "rw" => ["required", "max:3"],
        ];
    }



    public function create()
    {

        $this->validate();

        Household::create(
            $this->all()
        );

        session()->flash('statusMessage', 'Data anda berhasil ditambahkan!.');
        $this->resetForm();
    }


    public function resetForm()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.form-household');
    }
}

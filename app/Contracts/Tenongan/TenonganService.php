<?php
namespace App\Contracts\Tenongan;
/**
 * TenonganService
 */
interface TenonganService
{
    /**
     * Menambah
     *
     * @param array $attribute
     * @return void
     */
    public function transact();
    public function pay();
    public function test();


    public function setKas();
    public function getKas();
    public function getLogKas();
    public function increaseKas(array $attribute);
    public function decreaseKas(array $attribute);

    public function increaseSaldo(array $attribute);
    public function decreaseSaldo(array $attribute);

    public function createPedagang(array $attribute);
    public function createProdusen(array $attribute);

    public function createPenjualans(array $attribute);
}

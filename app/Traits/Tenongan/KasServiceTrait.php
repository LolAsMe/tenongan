<?php
namespace App\Traits\Tenongan;
use App\Models\Tenongan\Kas;
trait KasServiceTrait
{
    protected $kas;

    public function setKas(int $id=1)
    {
        $this->kas = Kas::find($id);
        return $this;
    }

    public function getKas()
    {
        return $this->kas;
    }
    public function increaseKas(array $attribute)
    {
        $this->kas->increase($attribute['jumlah'], $attribute);
    }
    public function decreaseKas(array $attribute)
    {
        $this->kas->increase($attribute['jumlah'], $attribute);
    }

    public function getLogKas()
    {
        return $this->kas->getLastLog();
    }
}

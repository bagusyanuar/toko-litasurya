<?php


namespace App\Domain\Web\Point;


use App\Commons\Request\DTORequest;

class DTOMutate extends DTORequest
{
    private $point;
    private $nominal;

    protected function rules()
    {
        return [
            'point' => 'required|numeric',
            'nominal' => 'required|numeric'
        ];
    }

    public function hydrate()
    {
        $point = $this->dtoForm['point'] ? intval(str_replace('.', '',  $this->dtoForm['point'])) : 0;
        $nominal = $this->dtoForm['nominal'] ? intval(str_replace('.', '',  $this->dtoForm['nominal'])) : 0;

        $this->setPoint($point)
            ->setNominal($nominal);
    }

    public function dehydrate()
    {
        return [
            'point' => $this->getPoint(),
            'nominal' => $this->getNominal()
        ];
    }

    /**
     * @return mixed
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * @param mixed $point
     * @return DTOMutate
     */
    public function setPoint($point)
    {
        $this->point = $point;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNominal()
    {
        return $this->nominal;
    }

    /**
     * @param mixed $nominal
     * @return DTOMutate
     */
    public function setNominal($nominal)
    {
        $this->nominal = $nominal;
        return $this;
    }
}

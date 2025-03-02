<?php


namespace App\Domain\Web\Route;


use App\Commons\Request\DTORequest;

class DTOMutate extends DTORequest
{
    /** @var string $name */
    private $name;
    /** @var array  $stores*/
    private $stores;

    protected function rules()
    {
        return [
            'name' => 'required',
            'stores' => 'required|array|min:1',
        ];
    }

    public function hydrate()
    {
        $name = $this->dtoForm['name'];
        $stores = $this->dtoForm['stores'];

        $this->setName($name)
            ->setStores($stores);
    }

    public function dehydrate()
    {
        return [
            'name' => $this->getName(),
            'stores' => $this->getStores()
        ];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return DTOMutate
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function getStores()
    {
        return $this->stores;
    }

    /**
     * @param array $stores
     * @return DTOMutate
     */
    public function setStores($stores)
    {
        $this->stores = $stores;
        return $this;
    }
}

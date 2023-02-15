<?php

namespace App\Http\Controllers;

use App\Http\Exceptions\DefaultException;
use App\Http\Exceptions\NotFoundException;
use App\Http\Exceptions\UnprocessableEntityException;
use App\Models\Car;

use Swoole\Http\Request;

class CarsController
{

    /**
     * @return array
     */
    public function index(): array
    {
        try {
            $cars = (new Car())->all();

            if(!count($cars))
                throw new NotFoundException();

            return response($cars);
        } catch (\Exception $error) {
            return (new DefaultException($error))->getError();
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function show(Request $request): array
    {
        try {

            if(!$car = (new Car())->find($request->get['id']))
                throw new NotFoundException();

            return response(
                $car
            );

        } catch (\Exception $error) {
            return (new DefaultException($error))->getError();
        }
    }


    /**
     * @param Request $request
     * @return array
     */
    public function search(Request $request): array
    {
        try {

            if(!$car = (new Car())->search($request->get['q']))
                throw new NotFoundException();

            return response(
                $car
            );

        } catch (\Exception $error) {
            return (new DefaultException($error))->getError();
        }
    }


    /**
     * @param Request $request
     * @return array
     */
    public function store(Request $request): array
    {
        try {

            $data = $this->validationForm($request);

            (new Car())->insert($data);

            return response([]);
        } catch (\Exception $error) {
            echo $error->getMessage();
            return (new DefaultException($error))->getError();
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function update(Request $request): array
    {
        try {

            $data = $this->validationForm($request);

            if($data['id'] === null || $data['id'] === '')
                throw new UnprocessableEntityException('O campo `id` é obrigatório');

            $id = $data['id'];

            if(!(new Car())->find($id))
                throw new NotFoundException();

            unset($data['id']);

            (new Car())->update($data, $id);

            return response([]);
        } catch (\Exception $error) {
            echo $error->getMessage();
            return (new DefaultException($error))->getError();
        }
    }



    /**
     * @param Request $request
     * @return array
     */
    public function delete(Request $request): array
    {
        try {

            if(!$data = $request->post)
                throw new UnprocessableEntityException();

            if($data['id'] === null || $data['id'] === '')
                throw new UnprocessableEntityException('O campo `id` é obrigatório');

            $id = $data['id'];

            (new Car())->delete($id);

            return response([]);
        } catch (\Exception $error) {
            echo $error->getMessage();
            return (new DefaultException($error))->getError();
        }
    }

    /**
     * @param Request $request
     * @return array
     * @throws UnprocessableEntityException
     */
    protected function validationForm(Request $request): array
    {
        if(!$data = $request->post)
            throw new UnprocessableEntityException();

        if(!$data['vehicle'])
            throw new UnprocessableEntityException('O campo `Veículo` é obrigatório');

        if(!$data['manufacturer'])
            throw new UnprocessableEntityException('O campo `Marca` é obrigatório');

        if(!$data['year'])
            throw new UnprocessableEntityException('O campo `Ano` é obrigatório');

        if(!$data['description'])
            throw new UnprocessableEntityException('O campo `Descrição` é obrigatório');

        if($data['is_sold'] === null || $data['is_sold'] === '')
            $data['is_sold'] = 0;

        if(intval($data['is_sold']) !== 0 && intval($data['is_sold']) !== 1)
            throw new UnprocessableEntityException('O campo `Vendido` está inválido');

        return $data;
    }

}
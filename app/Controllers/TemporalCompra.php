<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TemporalCompraModel;
use App\Models\ProductosModel;

class TemporalCompra extends BaseController
{
    protected $temporal_compra, $productos;

    public function __construct()
    {
        $this->temporal_compra = new TemporalCompraModel();
        $this->productos = new ProductosModel();
    }

    public function inserta($id_producto, $cantidad, $id_compra)
    {
        $error = '';
        $producto = $this->productos->where('id',$id_producto)->first();

        if($producto){
            $existente = $this->temporal_compra->porIdProductoCompra($id_compra,$id_producto);
            if($existente){
                $cantidad = $cantidad + $existente->cantidad;
                $subtotal = $cantidad * $existente->precio;

                $this->temporal_compra->actualizarProductoCompra($id_producto,$id_compra,$cantidad,$subtotal);

            }else{
                $subtotal = $cantidad * $producto['precio_compra'];
                $datos = [
                    'nombre' => $producto['nombre'],
                    'folio' => $id_compra,
                    'id_producto' => $id_producto,
                    'cantidad' => $cantidad,
                    'subtotal' => $subtotal,
                    'precio' => $producto['precio_compra'],
                    'codigo' => $producto['codigo']
                ];

                $this->temporal_compra->save($datos);
            }

        }else{
            $error = 'No existe el producto';
        }

        $res['datos'] = $this->cargaProductos($id_compra);
        $res['error'] = $error;
        $res['total'] = number_format($this->totalProductos($id_compra),2);
        
        echo json_encode($res);
    }

    public function cargaProductos($id_compra){

        $resultados = $this->temporal_compra->porCompra($id_compra);

        $fila = '';
        $numFila = 0;

        foreach($resultados as $row){

            $numFila++;
            $fila .= '<tr id="fila'. $numFila .'" >';
            $fila .= '<td>'. $numFila . '</td>';
            $fila .= '<td>'. $row['codigo'] . '</td>';
            $fila .= '<td>'. $row['nombre'] . '</td>';
            $fila .= '<td>'. number_format($row['precio'],2) . '</td>';
            $fila .= '<td>'. $row['cantidad'] . '</td>';
            $fila .= '<td>'. number_format($row['subtotal'],2) . '</td>';
            $fila .= '<td><a onclick="eliminaProducto('. $row['id_producto'] . ',\''. $id_compra . '\')" class="borrar" ><span class="fas fa-fw fa-trash"></span></a></td>';
            $fila .= '</tr>';

        }

        return $fila;

    }

    public function totalProductos($id_compra){

        $resultados = $this->temporal_compra->porCompra($id_compra);

        $total = 0;

        foreach($resultados as $row){

            $total += $row['subtotal'];

        }

        return $total;

    }

    public function eliminar($id_producto, $id_compra){

        $error = '';

        $existente = $this->temporal_compra->porIdProductoCompra($id_compra,$id_producto);

        if($existente){
            if($existente->cantidad > 1){

                $cantidad = $existente->cantidad - 1;
                $subtotal = $cantidad * $existente->precio;
                
                $this->temporal_compra->actualizarProductoCompra($id_producto,$id_compra,$cantidad,$subtotal);

            }else{

                $this->temporal_compra->eliminarProductoCompra($id_producto,$id_compra);

            }

        }else{
            $error = 'No existe ese producto';
        }

        $res['datos'] = $this->cargaProductos($id_compra);
        $res['error'] = $error;
        $res['total'] = number_format($this->totalProductos($id_compra),2);
        
        echo json_encode($res);

    }
}

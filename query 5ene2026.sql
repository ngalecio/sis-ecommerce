select precio,precio_compra,stock,stock_fraccion,costo_promedio,a.* from productos a order by updated_at desc 

alter table productos add unidad_medida varchar(100)
alter table productos add cantidad_medida decimal(10,2) 
alter table productos add cantidad_por_unidad decimal(10,2) 
alter table productos add stock_fraccion decimal(10,2)

select * from categorias

select * from comprobante_cabeceras

update productos set cantidad_por_unidad = 1


select * from consulta_detalles

update productos set costo_promedio = 10.50 where id = 123;
update productos set costo_promedio = 22.87 where id = 124;

select * from clientes


select id,nombre,stock,costo_promedio,unidad_medida,cantidad_por_unidad,stock_fraccion 
from productos where id in (123,124,125)

update productos set stock_fraccion = 0,stock = 150, costo_promedio = 24

delete from kardexes;

SELECT * FROm kardexes where producto_id in (125)





alter table consulta_detalles add unidad_medida varchar(20)
alter table consulta_detalles add precio_fraccion decimal(11,2)


update productos set unidad_medida = 'UNIDAD'


delete from pacientes where id <= 1700

delete from clientes where id <= 1800

select 

delete from comprobante_cabeceras where year(fecha) <= 2024

delete from comprobante_detalles where comprobante_id in (

select id from comprobante_cabeceras where year(fecha) <= 2024)


select * from productos where categoria_id != 11

delete from productos where categoria_id != 11


select * from producto_imagens

see



alter table kardexes add ant_cantidad_fraccion decimal(11,5)
alter table kardexes add ant_costo_fraccion decimal(11,5)
alter table kardexes add ant_costo_fraccion_total decimal(11,5)

alter table kardexes add nue_cantidad_fraccion decimal(11,5);
alter table kardexes add nue_costo_fraccion decimal(11,5);
alter table kardexes add nue_costo_fraccion_total decimal(11,5);


alter table kardexes add act_cantidad_fraccion decimal(11,5);
alter table kardexes add act_costo_fraccion decimal(11,5);
alter table kardexes add act_costo_fraccion_total decimal(11,5);

select * from kardexes

SELECT * From productos where id = 123

select 268*209.17626;

http://vmi1057060.contaboserver.net:9090/jasperserver/rest_v2/reports/reports/strada/crm_lista_precios.pdf?&j_username=jasperadmin&j_password=Todotek.2023@**&id_empresa=1&filtro=&campofiltro=PERSONALIZADO&marca=GM

select * from comprobante_cabeceras where tipo_comprobante = 'CO'
order by id  desc 

select *from clientes

select * from catalogo_detalles

INSERT INTO sucursals (codigo_sucursal,nombre,direccion,telefono,correo,estado) VALUES
('001','MATRIZ - GYE','LA PUNTILLA SATELITE /AV PRINCIPAL SECTOR LOS ARCOS','0993912916','dralourdescerna@gmail.com','A'),
('003','Agencia - Quito','CENTRO','04','correo@algo.com','A');


INSERT INTO secuencias (tipo_comprobante,establecimiento,punto_emision,secuencia) VALUES
('A1','001','002',1),('A1','002','002',1),('A1','003','002',1),('A1','004','002',1),('A1','005','002',1),('A1','006','002',1),
('A2','001','001',1),('A2','001','002',1),('A2','002','002',1),('A2','003','002',1),('A2','004','002',1),('A2','005','002',1),('A2','006','002',1),
('DC','002','002',1),('DC','003','002',1),('DC','004','002',1),('DC','005','002',1),('DC','006','002',1),('DV','002','002',1),('DV','003','002',1),('DV','004','002',1),('DV','005','002',1),('DV','006','002',1),
('FA','001','001',1196),('FA','001','002',1102),('FA','002','002',87),('FA','003','001',190),('FA','003','002',87),('FA','004','002',419),('FA','005','002',450),('FA','006','002',851),
('GT','001','001',172),('GT','002','002',275),('GT','003','001',25),('GT','004','002',53),('GT','005','002',25),('GT','006','002',39);



select * from tipo_comprobantes

delete from tipo_comprobantes;

INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)
 VALUES ('A1', 'AJUSTE NEGATIVO', '', '', '', '1.01.03.06.001', '', '', '', '', '6.02.22.03.001', '', '', '', '', '', '', 'Inv.Comprados(Produc.Termin.y Mercaderias)', '', '', '', '', '', '', '', '', 'SI', '', '', '', '', '', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)

VALUES ('A2', 'AJUSTE POSITIVO', '', '', '', '1.01.03.06.001', '', '', '', '', '4.01.01.02.001', '', '', '', '', '', '', 'Inv.Comprados(Produc.Termin.y Mercaderias)', '', '', '', '', '', '', '', '', 'SI', '', '', '', '', '', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)

VALUES ('AS', 'ASIENTO CONTABLE', '', '', '', '', '', '', '', '', '', 'ventas 8', '', '', '', '', '', '', '', '', '', '', '', '1111', 'vnt', '', 'NO', '', '', '', '', '', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');

INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)

VALUES ('BA', 'MOVIMIENTO BANCO', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'SI', '', '', '', '', '', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');

INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)
 
VALUES ('CB', 'COBROS FACTURA', '', '', '', '', '', '', '', '', '', 'ventas 7', 'Clientes Locales', '', '', '', '', '', '', '', '', '', '', '2222', '1.01.02.06.001', '', 'SI', '1.01.01.01.001', '', '', 'Caja General', '', '', 'N', 'H', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'D', 'N', 'N');
INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)

VALUES ('CC', 'CIERRE DE CAJA', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'SI', '1.01.01.01.001', '', '1.01.01.01.002', 'Caja General', '', 'Caja Chica', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)

VALUES ('CO', 'COMPRA', '', '', '', '1.01.03.05.001', '2.01.03.01.001', '2.01.07.01.001', '2.01.07.01.001', '', '', '', '', '', '', '', '', 'Inv.Producidos (Produc.Termin.y Mercaderias)', 'Cuentas y Docum.por Pagar Relacionados Locales', '12% IVA Ventas Locales (Excluye Activos Fijos)', '', '', '', '3333', 'vnt', '', 'SI', '1.01.01.01.001', '', '', 'Caja General', '', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)

VALUES ('DC', 'DEVOLUCION COMPRA', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'SI', '', '', '', '', '', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)

VALUES ('DI', 'DIARIO NUEVO', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'SI', '', '', '', '', '', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)
 
VALUES ('DV', 'DEVOLUCION VENTA', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'SI', '', '', '', '', '', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)

VALUES ('FA', 'FACTURAS', '4.01.01.01.001', '', '5.04.01.01.001', '1.01.03.05.001', '1.01.02.05.001', '', '', '', '', 'Productos Terminados A', 'Clientes Locales', '12% IVA Ventas Locales (Excluye Activos Fijos)', 'Productos Terminados A', '', 'Costo de Ventas Producto A', 'Inv.Producidos (Produc.Termin.y Mercaderias)', 'Clientes Locales', '', '', '', '', '4.01.01.01.001', '1.01.02.05.001', '2.01.07.01.001', 'SI', '', '', '', '', '', '', 'D', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)
 
VALUES ('GA', 'REGISTRO DE GASTOS', '', '', '', '', '2.01.03.01.001', '2.01.07.01.001', '2.01.07.01.001', '', '', '', '', '', '', '', '', '', 'Cuentas y Docum.por Pagar Relacionados Locales', '12% IVA Ventas Locales (Excluye Activos Fijos)', '', '', '', '', '', '', 'SI', '', '', '', '', '', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)

VALUES ('GT', 'GUIA DE TRANSPORTE', '', '', '', '', '', '', '', '', '', 'ventas 2', '', '', '', '', '', '', '', '', '', '', '', '5555', '', '', 'NO', '', '', '', '', '', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)

VALUES ('NC', 'NOTE DE CREDITO', '', '', '', '', '', '', '', '', '', 'ventas 3', '', '', '', '', '', '', '', '', '', '', '', '777', '', '', 'SI', '', '', '', '', '', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)

VALUES ('ND', 'NOTA DE DEBITO', '', '', '', '', '', '', '', '', '', 'ventas 4', '', '', '', '', '', '', '', '', '', '', '', '8888', '', '', 'SI', '', '', '', '', '', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)

VALUES ('NP', 'NOTA DE CREDITO COMPRA', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'SI', '', '', '', '', '', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)

VALUES ('PA', 'PAGOS', '', '', '', '', '2.01.03.01.001', '', '', '', '', 'ventas 5', '', '', '', '', '', '', 'Cuentas y Docum.por Pagar Relacionados Locales', '', '', '', '', '999', '', '', 'SI', '1.01.01.01.001', '', '', 'Caja General', '', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)

VALUES ('RE', 'RETENCION', '', '', '', '', '', '', '', '', '', 'ventas 6', '', '', '', '', '', '', '', '', '', '', '', '00000', '', '', 'NO', '', '', '', '', '', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)

VALUES ('RV', 'RETENCION EN VENTA', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'SI', '', '', '', '', '', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');
INSERT INTO tipo_comprobantes (codigo,nombre,descuento_ventas,ice_ventas,costo_ventas,inventario,cuentas_por_pagar,iva_compras,retencion_fuente,retencion_iva,otra_cuenta,nombre_ventas,nombre_cuentas_por_cobrar,nombre_iva_ventas,nombre_descuento_ventas,nombre_ice_ventas,nombre_costo_ventas,nombre_inventario,nombre_cuentas_por_pagar,nombre_iva_compras,nombre_retencion_fuente,nombre_retencion_iva,nombre_otra_cuenta,ventas,cuentas_por_cobrar,iva_ventas,tiene_asiento,caja_recaudacion,caja_cierre,caja_chica,nombre_caja_recaudacion,nombre_caja_cierre,nombre_caja_chica,nat1,nat2,nat3,nat4,nat5,nat6,nat7,nat8,nat9,nat10,nat11,nat12,nat13,nat14,nat15)

VALUES ('VC', 'CAJA CHICA', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'SI', '', '', '1.01.01.01.002', '', '', 'Caja Chica', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N');



select * from comprobante_detalles 

select * from comprobante_cabeceras where id = 17958
select * from sucursals
select * from secuencias

select * from tipo_comprobantes

select * from secuencia where establecimiento = '001'

select *from comprobante_cabeceras where id = 17958



SELECT 
    COLUMN_NAME     AS campo,
    COLUMN_TYPE     AS tipo,
    IS_NULLABLE     AS nulo,
    COLUMN_DEFAULT  AS valor_default,
    EXTRA
FROM information_schema.COLUMNS
WHERE TABLE_SCHEMA = DATABASE()
  AND TABLE_NAME = 'secuencia'
ORDER BY ORDINAL_POSITION;

select * from sucursal



select * from comprobante_cabeceras where id in(17973, 17979)
select * from comprobante_detalles;

drop table comprobante_detalles;

select * from catalogo_detalles where codigo_catalogo = 'CONDICION_CREDITO'

update clientes
set tipo_persona = 'CYP' 
limit 30

select * from 

 LIMIT 100 

UPDATE comprobante_cabeceras 
SET cliente_id = 
where tipo_comprobante = 'CO' 
and id+40 in (select id from clientes)
and cliente_id = 1
LIMIT 100 

SET @counter = 0;

UPDATE comprobante_cabeceras 
SET cliente_id = (@counter := IF(@counter >= 10, 1, @counter + 1))
WHERE tipo_comprobante = 'CO';


select count(1) from pacientes;


select * from clientes
select * from catalogo_detalles

select * from consulta_detalles

select * from consulta_imagens

select *from paciente ORDER BY id ;
select * from pacientes WHERE id = 1
select * from compro


select * from comprobante_cabeceras;
delete from comprobante_cabeceras

CREATE TABLE `clientes`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(200) ,
  `apellidos` varchar(200) ,
  `direccion` varchar(400) ,
  `telefono` varchar(10) ,
  `celular` varchar(10) ,
  `cedula` varchar(20) ,
  `ruc` varchar(20) ,
  `email` varchar(200) ,
  `estado` varchar(1),
  `es_cliente` char(1) ,
  `es_proveedor` char(1) ,
  `tipo_identificacion` varchar(20) ,
  `tipo_persona` varchar(3) ,
  `credito_usado` decimal(11, 5) ,
  `credito_saldo` decimal(11, 5),
  `cupo_credito` decimal(11, 5) ,
  `tipo_contribuyente` varchar(10) ,
  PRIMARY KEY (`id`) 
)

ALTER TABLE clientes
ADD COLUMN created_at TIMESTAMP NULL DEFAULT NULL,
ADD COLUMN updated_at TIMESTAMP NULL DEFAULT NULL;

drop table pacientes;


select * from pacientes

select *from consultas


drop table consultas ;

alter table consultas modify column fecha date;
CREATE TABLE consultas
`  (
	 id bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha` date NULL DEFAULT NULL,
  `paciente_id` bigint NULL,
  `tipo_consulta` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `comentario_1` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `comentario_2` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `comentario_3` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `comentario_4` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `establecimiento` varchar(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `alergias` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `medicamentos` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `antecedentes_personales` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
  `antecedentes_familiares` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NULL DEFAULT NULL,
	 created_at TIMESTAMP ,
   updated_at TIMESTAMP ,
  PRIMARY KEY (id) 
) ENGINE = InnoDB


CREATE TABLE pacientes  (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(200) ,
  `apellidos` varchar(200),
  `direccion` varchar(400) ,
  `telefono` varchar(10) ,
  `celular` varchar(10),
  `cedula` varchar(20),
  `ruc` varchar(20) ,
  `email` varchar(200) ,
  `estado` varchar(1) ,
  `es_cliente` char(1) ,
  `es_proveedor` char(1) ,
  `tipo_identificacion` varchar(20) ,
  `tipo_persona` varchar(30) ,
  `credito_usado` decimal(11, 5) ,
  `credito_saldo` decimal(11, 5) ,
  `cupo_credito` decimal(11, 5) ,
  `tipo_contribuyente` varchar(10), 
  `fecha_nacimiento` date ,
  `medicamentos` varchar(1000) ,
  `antecedentes_personales` varchar(1000) ,
  `alergias` varchar(1000) ,
  `antecedentes_familiares` varchar(1000) ,
  `establecimiento` varchar(3),
  PRIMARY KEY (`id`) 
)
ALTER TABLE pacientes MODIFY COLUMN celular VARCHAR(20);

ALTER TABLE pacientes MODIFY COLUMN telefono VARCHAR(50);


ALTER TABLE pacientes
ADD COLUMN created_at TIMESTAMP NULL DEFAULT NULL,
ADD COLUMN updated_at TIMESTAMP NULL DEFAULT NULL;


DROP TABLE IF EXISTS `producto_imagens`;
CREATE TABLE `producto_imagens`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `producto_id` bigint UNSIGNED NOT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `producto_imagens_producto_id_foreign`(`producto_id` ASC) USING BTREE,
  CONSTRAINT `producto_imagens_producto_id_foreign` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB

drop table productos;

CREATE TABLE `productos`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT ,
	codigo varchar(100),
  `nombre` varchar(200) ,
  `descripcion` text,
  `lote` varchar(20) ,
  `categoria_id` int NULL,
  `presentacion_id` int NULL,
  `imagen` varchar(500) ,
  `lote_estandar` decimal(11, 5) ,
  `registro_sanitario` varchar(100) ,
  `tipo_receta` varchar(2) NULL,
  `version` varchar(20) ,
  `stock` decimal(11, 2) ,
  `precio` decimal(11, 2) ,
  `costo` decimal(11, 2) ,
  `imprime_receta` char(1) ,
  `tipo_producto` char(1) ,
  `aplica_iva` varchar(2) ,
  `aplica_ice` varchar(10) ,
  `provedor_id` int NULL DEFAULT NULL,
  `porcentaje_ice` decimal(11, 5) NULL DEFAULT NULL,
  `tipo_contribuyente` varchar(20),
  `presentacion` text,
  `v_min` decimal(11, 5) ,
  `v_max` decimal(11, 5) ,
  `v_med` decimal(11, 5) ,
  `prescripcion` text ,
  `id_producto` int ,
  `precio_compra` decimal(11, 5) ,
  `fecha_compra` date ,
  `costo_promedio` decimal(11, 5) ,
  `estado` varchar(10),
  PRIMARY KEY (`id`) 
) ENGINE = InnoDB

select * from productos

ALTER TABLE productos
ADD COLUMN created_at TIMESTAMP NULL DEFAULT NULL,
ADD COLUMN updated_at TIMESTAMP NULL DEFAULT NULL;

delete from productos
ALTER TABLE productos
ADD COLUMN created_at TIMESTAMP NULL DEFAULT NULL,
ADD COLUMN updated_at TIMESTAMP NULL DEFAULT NULL;




delete from clientes;
delete from pacientes;

select * from pacientes

select * from productos

INSERT INTO catalogos (codigo, nombre) VALUES
('CONDICION_CREDITO', 'CONDICION DE CREDITO'),
('EXAMEN01', 'HEMATOLOGIA'),
('EXAMEN02', 'ESPECIAL'),
('EXAMEN03', 'BIOQUIMICA'),
('EXAMEN04', 'HEMOSTASIA'),
('EXAMEN05', 'ENDOCRINOS'),
('EXAMEN06', 'CORTISOL'),
('EXAMEN07', 'SEROLOGIA'),
('FORMA_PAGO', 'FORMAS DE PAGO'),
('RUTAS', 'RUTA DE GUIA DE TRANSPORTE'),
('TIPO_CONTRIBUYENTE', 'TIPO DE CONTRIBUYENTE SRI'),
('TIPO_TRATAMIENTO', 'TIPO DE TRATAMIENTO');

insert into catalogos(codigo, nombre) value('DIRECCION_GUIA','DIRECCION GUIA DE ENTREGA')
insert into catalogos(codigo, nombre) value('TIPO_PERSONA','TIPO_PERSONA')
insert into catalogos(codigo, nombre) value('FORMA_PAGO_SRI','FORMA_PAGO_SRI')
INSERT INTO catalogo_detalles
(catalogo_id, codigo_catalogo, codigo_catalogo_detalle, nombre, valor_1, valor_2, valor_3)
SELECT id, 'DIRECCION_GUIA', '001', 'TULCAN', 0,0,0 FROM catalogos WHERE codigo='DIRECCION_GUIA'
UNION ALL SELECT id,'DIRECCION_GUIA','002','Chical',0,0,0 FROM catalogos WHERE codigo='DIRECCION_GUIA'
UNION ALL SELECT id,'DIRECCION_GUIA','003','Maldonado',0,0,0 FROM catalogos WHERE codigo='DIRECCION_GUIA'
UNION ALL SELECT id,'DIRECCION_GUIA','004','Julio Andrade',0,0,0 FROM catalogos WHERE codigo='DIRECCION_GUIA'
UNION ALL SELECT id,'DIRECCION_GUIA','005','Ibarra',0,0,0 FROM catalogos WHERE codigo='DIRECCION_GUIA';

INSERT INTO catalogo_detalles
(catalogo_id, codigo_catalogo, codigo_catalogo_detalle, nombre, valor_1, valor_2, valor_3)
SELECT id,'TIPO_PERSONA','CLI','CLIENTE',0,0,0 FROM catalogos WHERE codigo='TIPO_PERSONA'
UNION ALL SELECT id,'TIPO_PERSONA','PRO','PROVEEDOR',0,0,0 FROM catalogos WHERE codigo='TIPO_PERSONA'
UNION ALL SELECT id,'TIPO_PERSONA','CYP','CLIENTE-PROVEEDOR',0,0,0 FROM catalogos WHERE codigo='TIPO_PERSONA'
UNION ALL SELECT id,'TIPO_PERSONA','TRA','TRANSPORTISTA',0,0,0 FROM catalogos WHERE codigo='TIPO_PERSONA';


INSERT INTO catalogo_detalles
(catalogo_id, codigo_catalogo, codigo_catalogo_detalle, nombre, valor_1, valor_2, valor_3)
SELECT id,'TIPO_CONTRIBUYENTE','1','Instituciones del Estado',0,0,0 FROM catalogos WHERE codigo='TIPO_CONTRIBUYENTE'
UNION ALL SELECT id,'TIPO_CONTRIBUYENTE','2','Compañías de aviación',0,0,0 FROM catalogos WHERE codigo='TIPO_CONTRIBUYENTE'
UNION ALL SELECT id,'TIPO_CONTRIBUYENTE','3','Agencias de Viaje',0,0,0 FROM catalogos WHERE codigo='TIPO_CONTRIBUYENTE'
UNION ALL SELECT id,'TIPO_CONTRIBUYENTE','4','Distribuidores de combustible',0,0,0 FROM catalogos WHERE codigo='TIPO_CONTRIBUYENTE'
UNION ALL SELECT id,'TIPO_CONTRIBUYENTE','9','Contribuyentes Especiales',0,0,0 FROM catalogos WHERE codigo='TIPO_CONTRIBUYENTE';

INSERT INTO catalogo_detalles
(catalogo_id, codigo_catalogo, codigo_catalogo_detalle, nombre, valor_1, valor_2, valor_3)
SELECT id,'FORMA_PAGO_SRI','1','SIN UTILIZACIÓN DEL SISTEMA FINANCIERO',0,0,0 FROM catalogos WHERE codigo='FORMA_PAGO_SRI'
UNION ALL SELECT id,'FORMA_PAGO_SRI','19','TARJETA DE CRÉDITO',0,0,0 FROM catalogos WHERE codigo='FORMA_PAGO_SRI'
UNION ALL SELECT id,'FORMA_PAGO_SRI','20','OTROS CON UTILIZACIÓN DEL SISTEMA FINANCIERO',0,0,0 FROM catalogos WHERE codigo='FORMA_PAGO_SRI';

INSERT INTO catalogo_detalles
(catalogo_id, codigo_catalogo, codigo_catalogo_detalle, nombre, valor_1, valor_2, valor_3)
SELECT id,'FORMA_PAGO','01','EFECTIVO',0,0,0 FROM catalogos WHERE codigo='FORMA_PAGO'
UNION ALL SELECT id,'FORMA_PAGO','02','CHEQUE',0,0,0 FROM catalogos WHERE codigo='FORMA_PAGO'
UNION ALL SELECT id,'FORMA_PAGO','03','TARJETA',0,0,0 FROM catalogos WHERE codigo='FORMA_PAGO'
UNION ALL SELECT id,'FORMA_PAGO','04','TRANSFERENCIA',0,0,0 FROM catalogos WHERE codigo='FORMA_PAGO'
UNION ALL SELECT id,'FORMA_PAGO','07','CHEQUE A FECHA',0,0,0 FROM catalogos WHERE codigo='FORMA_PAGO';

INSERT INTO catalogo_detalles
(catalogo_id, codigo_catalogo, codigo_catalogo_detalle, nombre, valor_1, valor_2, valor_3)
SELECT id,'CONDICION_CREDITO','1','CONTADO',0,0,0 FROM catalogos WHERE codigo='CONDICION_CREDITO'
UNION ALL SELECT id,'CONDICION_CREDITO','2','15 DIAS',15,0,0 FROM catalogos WHERE codigo='CONDICION_CREDITO'
UNION ALL SELECT id,'CONDICION_CREDITO','3','30 DIAS',30,0,0 FROM catalogos WHERE codigo='CONDICION_CREDITO'
UNION ALL SELECT id,'CONDICION_CREDITO','4','60 DIAS',60,0,0 FROM catalogos WHERE codigo='CONDICION_CREDITO'
UNION ALL SELECT id,'CONDICION_CREDITO','5','90 DIAS',90,0,0 FROM catalogos WHERE codigo='CONDICION_CREDITO';

INSERT INTO catalogo_detalles
(catalogo_id, codigo_catalogo, codigo_catalogo_detalle, nombre, valor_1, valor_2, valor_3)
SELECT id,'TIPO_TRATAMIENTO','TRA1','12 SESIONES',12,7,0 FROM catalogos WHERE codigo='TIPO_TRATAMIENTO'
UNION ALL SELECT id,'TIPO_TRATAMIENTO','TRA2','6 SESIONES',6,7,0 FROM catalogos WHERE codigo='TIPO_TRATAMIENTO'
UNION ALL SELECT id,'TIPO_TRATAMIENTO','TRA3','1 SESION',1,7,0 FROM catalogos WHERE codigo='TIPO_TRATAMIENTO';








drop table catalogo_detalles;
drop table catalogos;

select * from catalogo_detalles

select * from catalogos

select * from users

select *from categorias 

select * from model_has_roles

select * from categorias


select * from ajustes
select * from productos where imagen != ''

select * from productos

select *from users

alter table productos add id_usuario int 
alter table productos add id_usuario_modificacion int 


update productos set imagen = concat('imagenes/productos/',codigo,'.jpeg')
where imagen != ''

select * from users

select * from clientes

select count(1) from clientes

select * from clientes order by id asc ;

ALTER TABLE clientes AUTO_INCREMENT = 1;

delete from clientes;

ALTER TABLE clientes MODIFY COLUMN email VARCHAR(255) NULL;
ALTER TABLE clientes DROP INDEX clientes_email_unique;

delete from productos;

select * from productos
select * from categorias

delete from categorias;

INSERT INTO categorias (id, nombre, slug) VALUES
(1, 'SHAMPOO', 'shampoo'),
(2, 'ACONDICIONADORES', 'acondicionadores'),
(3, 'VITAMINAS', 'vitaminas'),
(4, 'COMPRIMIDOS - PASTILLAS', 'comprimidos-pastillas'),
(5, 'CEPILLOS', 'cepillos'),
(6, '---', 'sin-categoria'),
(7, 'ACCESORIOS', 'accesorios'),
(8, 'INSUMOS - COSMETICOS', 'insumos-cosmeticos'),
(9, 'LOCIONES', 'lociones'),
(10, 'HONORARIOS', 'honorarios'),
(11, 'PELUQUERIA', 'peluqueria');

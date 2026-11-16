--------------------------------------------------------------------------------------------------------
(ID)    (Descripción (Validar))         (Precondiciones)	    (Datos de Entrada)
TC-01	Descuento Obra Social	        Ninguna	                Monto: 1000
TC-02	Excepción por monto negativo	Ninguna                 Monto: -100
TC-03	Cadena de reportes	            Reporte base creado 	Texto: "Ventas"
--------------------------------------------------------------------------------------------------------
(Pasos)	                                                        (Resultado Esperado)
Instanciar ObraSocialStrategy y llamar a calculate(1000)       	Retorna 700
Instanciar Order con monto -100                                 Lanza InvalidArgumentException
Envolver en PdfDecorator y DigitalSignature                     Retorna texto con PDF y firma
--------------------------------------------------------------------------------------------------------
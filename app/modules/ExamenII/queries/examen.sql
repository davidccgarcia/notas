SELECT * FROM hc_evoluciones WHERE ingreso = 230 ORDER BY fecha DESC

DELETE  FROM hc_revision_por_sistemas WHERE ingreso = 230;

DELETE  FROM hc_evoluciones_submodulos WHERE ingreso = 230 AND evolucion_id = 4486; -- 4486 4481

SELECT      evolucion_id,
            ingreso, 
            fecha 
FROM        hc_evoluciones 
WHERE       ingreso = 230
ORDER BY    fecha_registro ASC
LIMIT       1

SELECT      A.evolucion_id,
            A.ingreso, 
            A.fecha_registro, 
            A.usuario_id,  
            C.usuario_id AS profesional 
FROM        hc_evoluciones AS A 
JOIN        profesionales AS C ON (A.usuario_id = C.usuario_id) 
WHERE       A.ingreso = 230 
AND         C.tipo_profesional IN ('1', '2')
ORDER BY    A.fecha_registro ASC 
LIMIT       1
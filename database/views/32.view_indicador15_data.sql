-- View: public.view_indicador15_data

-- DROP VIEW public.view_indicador15_data;

CREATE OR REPLACE VIEW public.view_indicador15_data
 AS
 SELECT 
 	a.region,
    a.procedimiento,
    a.year,
    a.month,
	((((a.month || '/'::text) || '01'::text) || '/'::text) || a.year)::date AS fecha,
	a.monto_cambio as amount_change,
	a.total as register_number,
    --a.monto_cambio::double precision / a.total::double precision AS porcentaje,
    a.variabilidad
   FROM view_m_indicador15 a;

ALTER TABLE public.view_indicador15_data
    OWNER TO postgres;


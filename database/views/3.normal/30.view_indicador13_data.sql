-- View: public.view_indicador13_data

-- DROP VIEW public.view_indicador13_data;

CREATE OR REPLACE VIEW public.view_indicador13_data
 AS
 SELECT a.region,
    (a.entidad_contratante::text || '-'::text) || a.region::text AS entidad_contratante,
    a.year,
    a.month,
	    ((((a.month || '/'::text) || '01'::text) || '/'::text) || a.year)::date AS fecha,

    a.monto_menores_0_5 AS amount_less_than_0_5,
	
    a.total AS register_number
   FROM view_m_indicador13 a;




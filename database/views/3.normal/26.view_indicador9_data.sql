-- View: public.view_indicador9_data

-- DROP VIEW public.view_indicador9_data;

CREATE OR REPLACE VIEW public.view_indicador9_data
 AS
 SELECT a.region,
    a.procedimiento,
    a.year,
    a.month,
	    ((((a.month || '/'::text) || '01'::text) || '/'::text) || a.year)::date AS fecha,

    a.mayor_30_dias AS greater_than_30_days,
    a.total AS register_number
   FROM view_m_indicador9 a;



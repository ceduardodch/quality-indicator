-- View: public.view_indicador12_data

-- DROP VIEW public.view_indicador12_data;

CREATE OR REPLACE VIEW public.view_indicador12_data
 AS
 SELECT a.region,
	    (a.proveedor::text || '-'::text) || a.region::text AS entidad_contratante,

    a.year,
    a.month,
    a.monto_menores_0_5 AS amount_less_than_0_5,
	    ((((a.month || '/'::text) || '01'::text) || '/'::text) || a.year)::date AS fecha,

    a.total AS register_number
   FROM view_m_indicador12 a;



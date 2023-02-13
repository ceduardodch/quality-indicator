-- View: public.view_indicador11_data

-- DROP VIEW public.view_indicador11_data;

CREATE OR REPLACE VIEW public.view_indicador11_data
 AS
 SELECT a.region,
    a.procedimiento,
    a.year,
    a.month,
    a.monto_menores_0_5 AS amount_less_than_0_5,
    a.total AS register_number
   FROM view_m_indicador11 a;

ALTER TABLE public.view_indicador11_data
    OWNER TO postgres;


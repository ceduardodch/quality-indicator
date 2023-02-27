-- View: public.view_m_indicador7

-- DROP MATERIALIZED VIEW IF EXISTS public.view_m_indicador7;

CREATE MATERIALIZED VIEW IF NOT EXISTS public.view_m_indicador7
TABLESPACE pg_default
AS
 SELECT party_address.region,
    release."buyerName" AS entidad_contratante,
    tender.method AS procedimiento,
    "substring"(release.date::text, 1, 4) AS year,
    "substring"(release.date::text, 6, 2) AS month,
    sum(
        CASE
            WHEN contract.amount IS NOT NULL THEN 1
            ELSE 0
        END) AS completos,
    count(1) AS total
   FROM party_address
     JOIN party ON party_address.party_id::text = party."partyId"::text
     JOIN release_party ON release_party.party_id::text = party."partyId"::text
     JOIN release ON release_party.release_id::text = release."releaseId"::text
     JOIN release_contract ON release."releaseId"::text = release_contract.release_id::text
     JOIN contract ON release_contract.contract_id::text = contract."contractId"::text
     JOIN tender ON tender.release_id::text = release."releaseId"::text
     JOIN tender_party ON tender_party.party_id::text = party."partyId"::text AND tender_party.tender_id::text = tender."tenderId"::text
	 WHERE  release.tag <> '["planning"]'::jsonb OR release.tag <> '["planning", "tender"]'::jsonb OR release.tag <> '["planning", "tender", "award"]'::jsonb
  	and substring(method,1,21) <> 'Catálogo electrónico '
  GROUP BY party_address.region, release."buyerName", tender.method, ("substring"(release.date::text, 1, 4)), ("substring"(release.date::text, 6, 2))
WITH DATA;

ALTER TABLE IF EXISTS public.view_m_indicador7
    OWNER TO "carlos.diaz";

GRANT ALL ON TABLE public.view_m_indicador7 TO "carlos.diaz";
GRANT INSERT, SELECT, UPDATE, DELETE ON TABLE public.view_m_indicador7 TO pruebas_datos_lectura_escritura;
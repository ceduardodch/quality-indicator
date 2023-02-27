-- View: public.view_m_indicador8

-- DROP MATERIALIZED VIEW IF EXISTS public.view_m_indicador8;

CREATE MATERIALIZED VIEW IF NOT EXISTS public.view_m_indicador8
TABLESPACE pg_default
AS
 SELECT party_address.region,
    release."buyerName" AS entidad_contratante,
    tender.method AS procedimiento,
    "substring"(release.date::text, 1, 4) AS year,
    "substring"(release.date::text, 6, 2) AS month,
    sum(
        CASE
            WHEN cp."startDate" IS NOT NULL AND cp."endDate" IS NOT NULL THEN 1
            ELSE 0
        END) AS completos,
    count(1) AS total
   FROM party_address
     JOIN party ON party_address.party_id::text = party."partyId"::text
     JOIN release_party ON release_party.party_id::text = party."partyId"::text
     JOIN release ON release_party.release_id::text = release."releaseId"::text
     JOIN release_contract ON release."releaseId"::text = release_contract.release_id::text
     JOIN contract ON release_contract.contract_id::text = contract."contractId"::text
     JOIN contract_period ON contract."contractId"::text = contract_period.contract_id::text
     JOIN period cp ON contract_period.period_id = cp.id
     JOIN tender ON tender.release_id::text = release."releaseId"::text
     JOIN tender_party ON tender_party.party_id::text = party."partyId"::text AND tender_party.tender_id::text = tender."tenderId"::text
	 	 WHERE  release.tag <> '["planning"]'::jsonb OR release.tag <> '["planning", "tender"]'::jsonb OR release.tag <> '["planning", "tender", "award"]'::jsonb
  		and substring(method,1,21) <> 'Catálogo electrónico '
  GROUP BY tender.method, party_address.region, release."buyerName", ("substring"(release.date::text, 1, 4)), ("substring"(release.date::text, 6, 2))
WITH DATA;

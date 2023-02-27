-- View: public.view_m_indicador2

-- DROP MATERIALIZED VIEW IF EXISTS public.view_m_indicador2;

CREATE MATERIALIZED VIEW IF NOT EXISTS public.view_m_indicador2
TABLESPACE pg_default
AS
 SELECT party_address.region,
    'Awards (adjudicación)'::text AS proceso,
    "substring"(release.date::text, 1, 4) AS year,
    "substring"(release.date::text, 6, 2) AS month,
    sum(
        CASE
            WHEN award.date IS NOT NULL THEN 1
            ELSE 0
        END) AS dateexist,
    count(1) AS conteo
   FROM party_address
     JOIN party ON party_address.party_id::text = party."partyId"::text
     JOIN release_party ON release_party.party_id::text = party."partyId"::text
     JOIN release ON release_party.release_id::text = release."releaseId"::text
     JOIN release_award ON release_award.release_id::text = release."releaseId"::text
     JOIN award_party ON award_party.party_id::text = party."partyId"::text AND release_award.award_id::text = award_party.award_id::text
     JOIN award ON award_party.award_id::text = award."awardId"::text AND release_award.award_id::text = award."awardId"::text
	 WHERE release.tag <> '["planning"]'::jsonb OR release.tag <> '["planning", "tender"]'::jsonb
  GROUP BY party_address.region, 'Awards (adjudicación)'::text, ("substring"(release.date::text, 1, 4)), ("substring"(release.date::text, 6, 2))
UNION ALL
 SELECT party_address.region,
    'Tender (licitación)'::text AS proceso,
    "substring"(release.date::text, 1, 4) AS year,
    "substring"(release.date::text, 6, 2) AS month,
    sum(
        CASE
            WHEN tp."startDate" IS NOT NULL AND tp."endDate" IS NOT NULL THEN 1
            ELSE 0
        END) AS dateexist,
    count(1) AS conteo
   FROM party_address
     JOIN party ON party_address.party_id::text = party."partyId"::text
     JOIN release_party ON release_party.party_id::text = party."partyId"::text
     JOIN release ON release_party.release_id::text = release."releaseId"::text
     JOIN tender_party ON tender_party.party_id::text = party."partyId"::text
     JOIN tender ON tender_party.tender_id::text = tender."tenderId"::text AND tender.release_id::text = release."releaseId"::text
     JOIN tender_period ON tender."tenderId"::text = tender_period.tender_id::text
     JOIN period tp ON tender_period.period_id = tp.id
	 WHERE release.tag <> '["planning"]'::jsonb
  GROUP BY party_address.region, 'Tender (licitación)'::text, ("substring"(release.date::text, 1, 4)), ("substring"(release.date::text, 6, 2))
UNION ALL
 SELECT party_address.region,
    'Contracts (contractual)'::text AS proceso,
    "substring"(release.date::text, 1, 4) AS year,
    "substring"(release.date::text, 6, 2) AS month,
    sum(
        CASE
            WHEN cp."startDate" IS NOT NULL AND cp."endDate" IS NOT NULL THEN 1
            ELSE 0
        END) AS dateexist,
    count(1) AS conteo
   FROM party_address
     JOIN party ON party_address.party_id::text = party."partyId"::text
     JOIN release_party ON release_party.party_id::text = party."partyId"::text
     JOIN release ON release_party.release_id::text = release."releaseId"::text
     JOIN release_contract ON release."releaseId"::text = release_contract.release_id::text
     JOIN contract ON release_contract.contract_id::text = contract."contractId"::text
     JOIN contract_period ON contract."contractId"::text = contract_period.contract_id::text
     JOIN period cp ON contract_period.period_id = cp.id
  WHERE release.tag <> '["planning"]'::jsonb OR release.tag <> '["planning", "tender"]'::jsonb OR release.tag <> '["planning", "tender", "award"]'::jsonb
  		and substring(method,1,21) <> 'Catálogo electrónico '
  GROUP BY party_address.region, 'Contracts (contractual)'::text, ("substring"(release.date::text, 1, 4)), ("substring"(release.date::text, 6, 2))
WITH DATA;

ALTER TABLE IF EXISTS public.view_m_indicador2
    OWNER TO "carlos.diaz";

GRANT ALL ON TABLE public.view_m_indicador2 TO "carlos.diaz";
GRANT INSERT, SELECT, UPDATE, DELETE ON TABLE public.view_m_indicador2 TO pruebas_datos_lectura_escritura;
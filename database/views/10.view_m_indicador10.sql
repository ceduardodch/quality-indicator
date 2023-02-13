-- View: public.view_m_indicador10

-- DROP MATERIALIZED VIEW IF EXISTS public.view_m_indicador10;

CREATE MATERIALIZED VIEW IF NOT EXISTS public.view_m_indicador10
TABLESPACE pg_default
AS
 SELECT party_address.region,
    tender.method AS procedimiento,
    "substring"(release.date::text, 1, 4) AS year,
    "substring"(release.date::text, 6, 2) AS month,
    sum(
        CASE
            WHEN tender.amount < 0.5 THEN 1
            ELSE 0
        END) AS monto_menores_0_5,
    count(1) AS total
   FROM party_address
     JOIN party ON party_address.party_id::text = party."partyId"::text
     JOIN release_party ON release_party.party_id::text = party."partyId"::text
     JOIN release ON release_party.release_id::text = release."releaseId"::text
     JOIN tender ON tender.release_id::text = release."releaseId"::text
     JOIN tender_party ON tender_party.party_id::text = party."partyId"::text AND tender_party.tender_id::text = tender."tenderId"::text
	  WHERE  release.tag <> '["planning"]'::jsonb
  GROUP BY party_address.region, tender.method, ("substring"(release.date::text, 1, 4)), ("substring"(release.date::text, 6, 2))
WITH DATA;

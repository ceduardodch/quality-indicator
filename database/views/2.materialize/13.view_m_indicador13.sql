-- View: public.view_m_indicador13

-- DROP MATERIALIZED VIEW IF EXISTS public.view_m_indicador13;

CREATE MATERIALIZED VIEW IF NOT EXISTS public.view_m_indicador13
TABLESPACE pg_default
AS
 SELECT party_address.region,
    release."buyerName" AS entidad_contratante,
    "substring"(release.date::text, 1, 4) AS year,
    "substring"(release.date::text, 6, 2) AS month,
    sum(
        CASE
            WHEN award.amount < 0.5 THEN 1
            ELSE 0
        END) AS monto_menores_0_5,
    count(1) AS total,
    release.tag AS fase
   FROM party_address
     JOIN party ON party_address.party_id::text = party."partyId"::text
     JOIN release_party ON release_party.party_id::text = party."partyId"::text
     JOIN release ON release_party.release_id::text = release."releaseId"::text
     JOIN release_award ON release_award.release_id::text = release."releaseId"::text
     JOIN award_party ON award_party.party_id::text = party."partyId"::text AND release_award.award_id::text = award_party.award_id::text
     JOIN award ON award_party.award_id::text = award."awardId"::text AND release_award.award_id::text = award."awardId"::text
	 WHERE  release.tag <> '["planning"]'::jsonb OR release.tag <> '["planning", "tender"]'::jsonb 
  GROUP BY party_address.region, release."buyerName", ("substring"(release.date::text, 1, 4)), ("substring"(release.date::text, 6, 2)), release.tag
WITH DATA;

-- View: public.view_m_indicador15

-- DROP MATERIALIZED VIEW IF EXISTS public.view_m_indicador15;

CREATE MATERIALIZED VIEW IF NOT EXISTS public.view_m_indicador15
TABLESPACE pg_default
AS
 SELECT party_address.region,
    tender.method AS procedimiento,
    "substring"(release.date::text, 1, 4) AS year,
    "substring"(release.date::text, 6, 2) AS month,
    sum(
        CASE
            WHEN award_item.entered_value <> award_item.corrected_value THEN 1
            ELSE 0
        END) AS monto_cambio,
    sum(award_item.entered_value - award_item.corrected_value) as variabilidad,
    count(1) AS total,
    release.tag AS fase
   FROM party_address
     JOIN party ON party_address.party_id::text = party."partyId"::text
     JOIN release_party ON release_party.party_id::text = party."partyId"::text
     JOIN release ON release_party.release_id::text = release."releaseId"::text
     JOIN release_award ON release_award.release_id::text = release."releaseId"::text
     JOIN award_party ON award_party.party_id::text = party."partyId"::text AND release_award.award_id::text = award_party.award_id::text
     JOIN award ON award_party.award_id::text = award."awardId"::text AND release_award.award_id::text = award."awardId"::text
     JOIN award_item ON award."awardId"::text = award_item.award_id::text
     JOIN tender ON tender.release_id::text = release."releaseId"::text
     JOIN tender_party ON tender_party.party_id::text = party."partyId"::text AND tender_party.tender_id::text = tender."tenderId"::text
  WHERE award_item.entered_value IS NOT NULL AND award_item.entered_value <> 0::numeric
  	 and  release.tag <> '["planning"]'::jsonb OR release.tag <> '["planning", "tender"]'::jsonb 
  	and substring(method,1,21) <> 'Catálogo electrónico '
  GROUP BY party_address.region, tender.method, ("substring"(release.date::text, 1, 4)), ("substring"(release.date::text, 6, 2)), release.tag
WITH DATA;
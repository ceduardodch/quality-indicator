-- View: public.view_indicador17_data

-- DROP VIEW public.view_indicador17_data;

CREATE OR REPLACE VIEW public.view_indicador17_data
 AS
 SELECT party_address.region AS prov,
    release.date AS fecha_inicial,
    award.amount AS award_amount,
    split_part(tender."procurementMethodDetails"::text, ' - '::text, 1) AS met_adq,
    release."buyerName" AS ent_cont,
    release.tag
   FROM party_address
     JOIN party ON party_address.party_id::text = party."partyId"::text
     LEFT JOIN release_party ON release_party.party_id::text = party."partyId"::text
     LEFT JOIN release ON release_party.release_id::text = release."releaseId"::text
     LEFT JOIN award_party ON award_party.party_id::text = party."partyId"::text
     LEFT JOIN award ON award_party.award_id::text = award."awardId"::text
     LEFT JOIN tender_party ON tender_party.party_id::text = party."partyId"::text
     LEFT JOIN tender ON tender_party.tender_id::text = tender."tenderId"::text;

ALTER TABLE public.view_indicador17_data
    OWNER TO postgres;


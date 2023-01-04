-- View: public.view_indicador5_data

-- DROP VIEW public.view_indicador5_data;

CREATE OR REPLACE VIEW public.view_indicador5_data
 AS
 SELECT party_address.region AS prov,
    release.date AS fecha_inicial,
    contract.amount AS contract_amount,
    split_part(tender."procurementMethodDetails"::text, ' - '::text, 1) AS met_adq,
    release."buyerName" AS ent_cont,
	--No se encuentra el campo tender.procurementEntity
	--No se encuentra el campo tender.procuringEntity
    release.tag
   FROM party_address
     JOIN party ON party_address.party_id::text = party."partyId"::text
     LEFT JOIN release_party ON release_party.party_id::text = party."partyId"::text
     LEFT JOIN release ON release_party.release_id::text = release."releaseId"::text
     LEFT JOIN award_party ON award_party.party_id::text = party."partyId"::text
     LEFT JOIN award ON award_party.award_id::text = award."awardId"::text
     LEFT JOIN contract ON award."awardId"::text = contract."awardID"::text
     LEFT JOIN tender_party ON tender_party.party_id::text = party."partyId"::text
     LEFT JOIN tender ON tender_party.tender_id::text = tender."tenderId"::text;

ALTER TABLE public.view_indicador5_data
    OWNER TO postgres;


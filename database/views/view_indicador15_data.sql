-- View: public.view_indicador15_data

CREATE OR REPLACE VIEW public.view_indicador15_data
 AS
 SELECT 
 	party_address.region AS prov,
    release.date AS fecha_inicial,
	award_item.corrected_value as monto_corr,
	award_item.entered_value as monto,
    split_part(tender."procurementMethodDetails"::text, ' - '::text, 1) AS met_adq,
    release.tag
   FROM party_address
     JOIN party ON party_address.party_id = party."partyId"
     LEFT JOIN release_party ON release_party.party_id = party."partyId"
     LEFT JOIN release ON release_party.release_id = release."releaseId"
     LEFT JOIN award_party ON award_party.party_id = party."partyId"
     LEFT JOIN award ON award_party.award_id = award."awardId"
	 LEFT JOIN award_item ON award."awardId" = award_item.award_id	 
     LEFT JOIN tender_party ON tender_party.party_id = party."partyId"
     LEFT JOIN tender ON tender_party.tender_id = tender."tenderId";

ALTER TABLE public.view_indicador15_data
    OWNER TO postgres;


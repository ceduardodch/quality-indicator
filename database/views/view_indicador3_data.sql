-- View: public.view_indicador3_data

CREATE OR REPLACE VIEW public.view_indicador3_data
 AS
 
 SELECT 
    party_address.region as prov,
    release.date as fecha_inicial,	
	award.amount as award_amount,
	SPLIT_PART(tender."procurementMethodDetails", ' - ', 1) as met_adq,
    release.tag
   FROM party_address  
     JOIN party ON party_address.party_id = party."partyId"
	 LEFT JOIN release_party ON release_party.party_id = party."partyId"
     LEFT JOIN release ON release_party.release_id = release."releaseId"
     LEFT JOIN award_party ON award_party.party_id = party."partyId"
     LEFT JOIN award ON award_party.award_id = award."awardId"
     LEFT JOIN tender_party ON tender_party.party_id = party."partyId"
     LEFT JOIN tender ON tender_party.tender_id = tender."tenderId";
  
ALTER TABLE public.view_indicador3_data
    OWNER TO postgres;


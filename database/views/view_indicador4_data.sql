-- View: public.view_indicador4_data

CREATE OR REPLACE VIEW public.view_indicador4_data
 AS
 
 SELECT 
    party_address.region as prov,
    release.date as fecha_inicial,	
	award.amount as award_amount,
	cp."startDate" as contract_startDate,
	cp."endDate" as contract_endDate,
	SPLIT_PART(tender."procurementMethodDetails", ' - ', 1) as met_adq,
    release.tag
   FROM party_address  
     JOIN party ON party_address.party_id = party."partyId"
	 LEFT JOIN release_party ON release_party.party_id = party."partyId"
     LEFT JOIN release ON release_party.release_id = release."releaseId"
     LEFT JOIN award_party ON award_party.party_id = party."partyId"
     LEFT JOIN award ON award_party.award_id = award."awardId"
	 LEFT JOIN contract ON award."awardId"::text = contract."awardID"
	 LEFT JOIN contract_period ON contract."contractId" = contract_period.contract_id
	 LEFT JOIN period cp ON contract_period.period_id = cp.id	
     LEFT JOIN tender_party ON tender_party.party_id = party."partyId"
     LEFT JOIN tender ON tender_party.tender_id = tender."tenderId";
  
ALTER TABLE public.view_indicador4_data
    OWNER TO postgres;


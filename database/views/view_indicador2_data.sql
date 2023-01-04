-- View: public.view_indicador2_data

CREATE OR REPLACE VIEW public.view_indicador2_data
 AS
 
 SELECT 
    party_address.region as prov,
    release.date as fecha_inicial,	
	award.date as award_date,   
	cp."startDate" as contract_startDate,
	cp."endDate" as contract_endDate,
	contract."dateSigned" as contract_dateSigned,
	ap."startDate" as award_startDate,
	ap."endDate" as award_endDate,
	tp."startDate" as tender_startDate,
	tp."endDate" as tender_endDate,
	tp."maxExtentDate" as tender_maxExtentDate,	
	SPLIT_PART(tender."procurementMethodDetails", ' - ', 1) as met_adq,
    release.tag
   FROM party 
     LEFT JOIN party_address ON party_address.party_id = party."partyId"
	 LEFT JOIN release_party ON release_party.party_id = party."partyId"
     LEFT JOIN release ON release_party.release_id = release."releaseId"
     LEFT JOIN award_party ON award_party.party_id = party."partyId"
     LEFT JOIN award ON award_party.award_id = award."awardId"
	 LEFT JOIN award_period ON award."awardId" = award_period.award_id
	 LEFT JOIN period ap ON award_period.period_id = ap.id
	 LEFT JOIN contract ON award."awardId"::text = contract."awardID"
	 LEFT JOIN contract_period ON contract."contractId" = contract_period.contract_id
	 LEFT JOIN period cp ON contract_period.period_id = cp.id	
     LEFT JOIN tender_party ON tender_party.party_id = party."partyId"
     LEFT JOIN tender ON tender_party.tender_id = tender."tenderId"
	 LEFT JOIN tender_period ON tender."tenderId" = tender_period.tender_id
	 LEFT JOIN period tp ON tender_period.period_id = ap.id;
  
ALTER TABLE public.view_indicador2_data
    OWNER TO postgres;


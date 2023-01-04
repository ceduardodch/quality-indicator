-- View: public.view_indicador1_data

CREATE OR REPLACE VIEW public.view_indicador1_data
 AS
 
 SELECT 
    party_address.region as prov,
    release.date as fecha_inicial,
	tender.amount as tender_amount,
	award.amount as award_amount,
    contract.amount as contract_amount,
	planning_budget.amount as planning_budget_amount,
	SPLIT_PART(tender."procurementMethodDetails", ' - ', 1) as met_adq,
    release.tag
   FROM party_address
     JOIN party ON party_address.party_id::text = party."partyId"::text
	 JOIN release_party ON release_party.party_id::text = party."partyId"::text
     JOIN release ON release_party.release_id::text = release."releaseId"::text	
     LEFT JOIN award_party ON award_party.party_id::text = party."partyId"::text
     LEFT JOIN award ON award_party.award_id::text = award."awardId"::text
	 LEFT JOIN contract ON award."awardId"::text = contract."awardID"
	 LEFT JOIN planning on release."releaseId" = planning.release_id
	 --Este cruce hay que revisar porque la tabla planning no tiene campo planningId
	 LEFT JOIN planning_budget ON planning.id::text = planning_budget.planning_id
     JOIN tender_party ON tender_party.party_id::text = party."partyId"::text
     JOIN tender ON tender_party.tender_id::text = tender."tenderId"::text
 /*WHERE release.tag <> '["plannig"]'::jsonb 
 	OR release.tag <> '["plannig", "tender"]'::jsonb
	OR release.tag <> '["plannig", "tender","award"]'::jsonb
	*/ ;
  
ALTER TABLE public.view_indicador1_data
    OWNER TO postgres;


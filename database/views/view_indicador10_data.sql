-- View: public.view_indicador10_data

CREATE OR REPLACE VIEW public.view_indicador10_data
 AS
 SELECT party_address.region AS prov,
    release.date AS fecha_inicial,    
	ap."startDate" as award_startDate,
	ap."endDate" as award_endDate,
	ap."maxExtentDate" as award_maxExtentDate,
	tender.amount AS tender_amount,
	tp."startDate" as tender_startDate,
	tp."endDate" as tender_endDate,
    split_part(tender."procurementMethodDetails"::text, ' - '::text, 1) AS met_adq,
    release."buyerName" AS ent_cont,	
    release.tag
   FROM party_address
     JOIN party ON party_address.party_id = party."partyId"
     LEFT JOIN release_party ON release_party.party_id = party."partyId"
     LEFT JOIN release ON release_party.release_id = release."releaseId"
     LEFT JOIN award_party ON award_party.party_id = party."partyId"
     LEFT JOIN award ON award_party.award_id = award."awardId"
	 LEFT JOIN award_period ON award."awardId" = award_period.award_id
	 LEFT JOIN period ap ON award_period.period_id = ap.id      
     LEFT JOIN tender_party ON tender_party.party_id = party."partyId"
     LEFT JOIN tender ON tender_party.tender_id = tender."tenderId"
	 LEFT JOIN tender_period ON tender."tenderId" = tender_period.tender_id
	 LEFT JOIN period tp ON tender_period.period_id = ap.id;

ALTER TABLE public.view_indicador10_data
    OWNER TO postgres;


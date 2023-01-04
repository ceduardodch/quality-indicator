-- View: public.view_indicador12_data

CREATE OR REPLACE VIEW public.view_indicador12_data
 AS
 SELECT 
 	party_address.region AS prov,
    release.date AS fecha_inicial,
	tender.amount AS tender_amount,
	tp."startDate" as tender_startDate,
	tp."endDate" as tender_endDate,
    split_part(tender."procurementMethodDetails"::text, ' - '::text, 1) AS met_adq,
    release."buyerName" AS ent_cont,	
    release.tag
	--No encuentro awards.suppliers.name
   FROM party_address
     JOIN party ON party_address.party_id = party."partyId"
     LEFT JOIN release_party ON release_party.party_id = party."partyId"
     LEFT JOIN release ON release_party.release_id = release."releaseId"
     LEFT JOIN award_party ON award_party.party_id = party."partyId"
     LEFT JOIN award ON award_party.award_id = award."awardId"     
     LEFT JOIN tender_party ON tender_party.party_id = party."partyId"
     LEFT JOIN tender ON tender_party.tender_id = tender."tenderId"
	 LEFT JOIN tender_period ON tender."tenderId" = tender_period.tender_id
	 LEFT JOIN period tp ON tender_period.period_id = tp.id;

ALTER TABLE public.view_indicador12_data
    OWNER TO postgres;


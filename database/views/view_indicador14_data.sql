-- View: public.view_indicador14_data

CREATE OR REPLACE VIEW public.view_indicador14_data
 AS
 SELECT 
 	party_address.region AS prov,
    release.date AS fecha_inicial,
	award.date AS award_date,
	cp."startDate" AS contract_startdate,
    cp."endDate" AS contract_enddate,
	award_item.corrected_value as monto_corr,
	award_item.entered_value as monto,
    split_part(tender."procurementMethodDetails"::text, ' - '::text, 1) AS met_adq,
    release."buyerName" AS ent_cont,	
    release.tag
   FROM party_address
     JOIN party ON party_address.party_id = party."partyId"
     LEFT JOIN release_party ON release_party.party_id = party."partyId"
     LEFT JOIN release ON release_party.release_id = release."releaseId"
     LEFT JOIN award_party ON award_party.party_id = party."partyId"
     LEFT JOIN award ON award_party.award_id = award."awardId"
	 LEFT JOIN award_item ON award."awardId" = award_item.award_id
	 LEFT JOIN contract ON award."awardId"::text = contract."awardID"::text
     LEFT JOIN contract_period ON contract."contractId"::text = contract_period.contract_id::text
     LEFT JOIN period cp ON contract_period.period_id = cp.id
     LEFT JOIN tender_party ON tender_party.party_id = party."partyId"
     LEFT JOIN tender ON tender_party.tender_id = tender."tenderId";

ALTER TABLE public.view_indicador14_data
    OWNER TO postgres;


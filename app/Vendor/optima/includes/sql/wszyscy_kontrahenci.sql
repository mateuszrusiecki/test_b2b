select
	kh.Knt_KntId as id,
	kh.Knt_Kod as kod,
	kh.Knt_Nazwa1 as nazwa1,
	kh.Knt_Nazwa2 as nazwa2,
	kh.Knt_Kraj as kraj,
	kh.Knt_Wojewodztwo as wojewodztwo,
	kh.Knt_KodPocztowy as kod_pocztowy,
	kh.Knt_Miasto as miasto,
	kh.Knt_Ulica as ulica,
	kh.Knt_NrDomu as nr_domu,
	kh.Knt_NrLokalu as nr_lokalu,
	kh.Knt_NipE as nip,
	kh.Knt_NipKraj as nip_kod_kraju_ue,
	kh.Knt_Telefon1 as telefon1,
	kh.Knt_Telefon2 as telefon2,
	kh.Knt_Email as email,
	(
		select convert(int, cast (ka.KnA_WartoscTxt as decimal(9,3))) as projekt
		from [CDN].[DefAtrybuty] atr,
			 [CDN].[KntAtrybuty] ka
		where atr.DeA_Typ = 2
		and atr.DeA_Kod = '{atrybut}'
		and ka.KnA_DeAId = atr.DeA_DeAId
		and ka.KnA_PodmiotId = kh.Knt_KntId
	) as atrybut_projekt

from [CDN].[Kontrahenci] kh


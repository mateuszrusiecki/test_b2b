select
	Knt_Kod as kod,
	convert(int, cast (KnA_WartoscTxt as decimal(9,3))) as atrybut_projekt

from
	[CDN].[DefAtrybuty],
	[CDN].[KntAtrybuty],
	[CDN].[Kontrahenci]

where DeA_Kod = '{atrybut}'
and DeA_Typ = 2
and DeA_DeAId = KnA_DeAId
and KnA_PodmiotTyp = 1
and Knt_PodmiotTyp = 1
and KnA_PodmiotId = Knt_KntId

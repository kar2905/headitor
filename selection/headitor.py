
# -*- coding: utf-8 -*-

# load required libraries
import json
import re
import sys
import mapper 
from Datumbox import DatumBox
from collections import Counter
from nltk.corpus import stopwords

# define Datumbox API key
api_key = '87f5dfbb1918c561806011fe9766b5c2'

def social_where(media):
	# load data
	text =''.join(open('texter.txt').readlines())
	sentences = re.split(r'\.',text)
	words = re.split(r'\ ',text)

	# text processing
	stop_corpus = stopwords.words('english')
	filtered_words = [w for w in words if not w in stopwords.words('english')]
	word_counts = Counter(filtered_words)

	# word count
	freq = {} 
	for word in filtered_words:
		if word in freq:
			freq[word] += 1
		else:
			freq[word] = 1

	sortedbyfrequency =  sorted(freq,key=freq.get,reverse=True)
	top_words = sortedbyfrequency[0:9]

	# initialize class
	box = DatumBox(api_key)

	# create empty python dict
	data = dict()

	# analysis via Datumbbox
	for item in sentences:
		for top in top_words:
			if str(sentences).find(top) != -1:
				sentiment = box.sentiment_analysis(item)
				subject = box.is_subjective(item)	
				data[item] = [sentiment,subject,item]

	if media in mapper.platform:
		status = mapper.platform[media]
	else:
		sys.exit()

	output = data[status[0]]

	return output

if __name__ == '__main__':
	print social_where('Twitter')

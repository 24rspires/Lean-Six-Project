
#https://www.zillow.com/delaware-county-oh/?searchQueryState=%7B%22isMapVisible%22%3Atrue%2C%22mapBounds%22%3A%7B%22north%22%3A40.50056938465655%2C%22south%22%3A40.068959965189805%2C%22east%22%3A-82.5955908779297%2C%22west%22%3A-83.39896612207032%7D%2C%22filterState%22%3A%7B%22sort%22%3A%7B%22value%22%3A%22globalrelevanceex%22%7D%2C%22ah%22%3A%7B%22value%22%3Atrue%7D%2C%22sche%22%3A%7B%22value%22%3Afalse%7D%2C%22schm%22%3A%7B%22value%22%3Afalse%7D%2C%22schh%22%3A%7B%22value%22%3Afalse%7D%2C%22schp%22%3A%7B%22value%22%3Afalse%7D%2C%22schr%22%3A%7B%22value%22%3Afalse%7D%2C%22schc%22%3A%7B%22value%22%3Afalse%7D%2C%22schu%22%3A%7B%22value%22%3Afalse%7D%7D%2C%22isListVisible%22%3Atrue%2C%22regionSelection%22%3A%5B%7B%22regionId%22%3A2249%2C%22regionType%22%3A4%7D%5D%2C%22pagination%22%3A%7B%7D%2C%22mapZoom%22%3A11%7D

ul_class = 'List-c11n-8-100-4__sc-1smrmqp-0 StyledSearchListWrapper-srp-8-100-4__sc-1ieen0c-0 cRHZNY laYCaY photo-cards photo-cards_extra-attribution'

def get_address_links(page):
    house_ul = page.find(class_=ul_class)
    print(house_ul)
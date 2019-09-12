<?php
/**
 * SCallback for the Schema organization type field.
 *
 * @package    Beeline_Plugin
 * @subpackage Admin\Partials\Field_Callbacks
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace Beeline_Plugin\Admin\Partials\Field_Callbacks;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

$types = [

	// First option save null.
	null          => __( 'Select one&hellip;', 'beeline-plugin' ),
	'Airline'     => __( 'Airline', 'beeline-plugin' ),
	'Corporation' => __( 'Corporation', 'beeline-plugin' ),

	// Educational Organizations.
	'EducationalOrganization' => __( 'Educational Organization', 'beeline-plugin' ),
		'CollegeOrUniversity' => __( '— College or University', 'beeline-plugin' ),
		'ElementarySchool'    => __( '— Elementary School', 'beeline-plugin' ),
		'HighSchool'          => __( '— High School', 'beeline-plugin' ),
		'MiddleSchool'        => __( '— Middle School', 'beeline-plugin' ),
		'Preschool'           => __( '— Preschool', 'beeline-plugin' ),
		'School'              => __( '— School', 'beeline-plugin' ),

	'GovernmentOrganization'  => __( 'Government Organization', 'beeline-plugin' ),

	// Local Businesses.
	'LocalBusiness' => __( 'Local Business', 'beeline-plugin' ),
		'AnimalShelter' => __( '— Animal Shelter', 'beeline-plugin' ),

		// Automotive Businesses.
		'AutomotiveBusiness' => __( '— Automotive Business', 'beeline-plugin' ),
			'AutoBodyShop'     => __( '—— Auto Body Shop', 'beeline-plugin' ),
			'AutoDealer'       => __( '—— Auto Dealer', 'beeline-plugin' ),
			'AutoPartsStore'   => __( '—— Auto Parts Store', 'beeline-plugin' ),
			'AutoRental'       => __( '—— Auto Rental', 'beeline-plugin' ),
			'AutoRepair'       => __( '—— Auto Repair', 'beeline-plugin' ),
			'AutoWash'         => __( '—— Auto Wash', 'beeline-plugin' ),
			'GasStation'       => __( '—— Gas Station', 'beeline-plugin' ),
			'MotorcycleDealer' => __( '—— Motorcycle Dealer', 'beeline-plugin' ),
			'MotorcycleRepair' => __( '—— Motorcycle Repair', 'beeline-plugin' ),

		'ChildCare'            => __( '— Child Care', 'beeline-plugin' ),
		'Dentist'              => __( '— Dentist', 'beeline-plugin' ),
		'DryCleaningOrLaundry' => __( '— Dry Cleaning or Laundry', 'beeline-plugin' ),

		// Emergency Services.
		'EmergencyService' => __( '— Emergency Service', 'beeline-plugin' ),
			'FireStation'   => __( '—— Fire Station', 'beeline-plugin' ),
			'Hospital'      => __( '—— Hospital', 'beeline-plugin' ),
			'PoliceStation' => __( '—— Police Station', 'beeline-plugin' ),

		'EmploymentAgency' => __( '— Employment Agency', 'beeline-plugin' ),

		// Entertainment Businesses.
		'EntertainmentBusiness' => __( '— Entertainment Business', 'beeline-plugin' ),
			'AdultEntertainment' => __( '—— Adult Entertainment', 'beeline-plugin' ),
			'AmusementPark'      => __( '—— Amusement Park', 'beeline-plugin' ),
			'ArtGallery'         => __( '—— Art Gallery', 'beeline-plugin' ),
			'Casino'             => __( '—— Casino', 'beeline-plugin' ),
			'ComedyClub'         => __( '—— Comedy Club', 'beeline-plugin' ),
			'MovieTheater'       => __( '—— Movie Theater', 'beeline-plugin' ),
			'NightClub'          => __( '—— Night Club', 'beeline-plugin' ),

		// Financial Services.
		'FinancialService' => __( '— Financial Service', 'beeline-plugin' ),
			'AccountingService' => __( '—— Accounting Service', 'beeline-plugin' ),
			'AutomatedTeller'   => __( '—— Automated Teller', 'beeline-plugin' ),
			'BankOrCreditUnion' => __( '—— Bank or Credit Union', 'beeline-plugin' ),
			'InsuranceAgency'   => __( '—— Insurance Agency', 'beeline-plugin' ),

		// Food Establishments.
		'FoodEstablishment' => __( '— Food Establishment', 'beeline-plugin' ),
			'Bakery'             => __( '—— Bakery', 'beeline-plugin' ),
			'BarOrPub'           => __( '—— Bar or Pub', 'beeline-plugin' ),
			'Brewery'            => __( '—— Brewery', 'beeline-plugin' ),
			'CafeOrCoffeeShop'   => __( '—— Cafe or Coffee Shop', 'beeline-plugin' ),
			'FastFoodRestaurant' => __( '—— Fast Food Restaurant', 'beeline-plugin' ),
			'IceCreamShop'       => __( '—— Ice Cream Shop', 'beeline-plugin' ),
			'Restaurant'         => __( '—— Restaurant', 'beeline-plugin' ),
			'Winery'             => __( '—— Winery', 'beeline-plugin' ),

		// Government Offices.
		'GovernmentOffice' => __( '— Government Office', 'beeline-plugin' ),
			'PostOffice' => __( '—— Post Office', 'beeline-plugin' ),

		// Health and Beauty Businesses.
		'HealthAndBeautyBusiness' => __( '— Health and Beauty Business', 'beeline-plugin' ),
			'BeautySalon'  => __( '—— Beauty Salon', 'beeline-plugin' ),
			'DaySpa'       => __( '—— Day Spa', 'beeline-plugin' ),
			'HairSalon'    => __( '—— Hair Salon', 'beeline-plugin' ),
			'HealthClub'   => __( '—— Health Club', 'beeline-plugin' ),
			'NailSalon'    => __( '—— Nail Salon', 'beeline-plugin' ),
			'TattooParlor' => __( '—— Tattoo Parlor', 'beeline-plugin' ),

		// Home and Construction Businesses.
		'HomeAndConstructionBusiness' => __( '— Home and Construction Business', 'beeline-plugin' ),
			'Electrician'       => __( '—— Electrician', 'beeline-plugin' ),
			'GeneralContractor' => __( '—— General Contractor', 'beeline-plugin' ),
			'HVACBusiness'      => __( '—— HVAC Business', 'beeline-plugin' ),
			'HousePainter'      => __( '—— House Painter', 'beeline-plugin' ),
			'Locksmith'         => __( '—— Locksmith', 'beeline-plugin' ),
			'MovingCompany'     => __( '—— MovingCompany', 'beeline-plugin' ),
			'Plumber'           => __( '—— Plumber', 'beeline-plugin' ),
			'RoofingContractor' => __( '—— Roofing Contractor', 'beeline-plugin' ),

		'InternetCafe' => __( '— Internet Cafe', 'beeline-plugin' ),

		// Legal Services.
		'LegalService' => __( '— Legal Service', 'beeline-plugin' ),
			'Attorney' => __( '—— Attorney', 'beeline-plugin' ),
			'Notary'   => __( '—— Notary', 'beeline-plugin' ),

		'Library' => __( '— Library', 'beeline-plugin' ),

		// Lodging Businesses.
		'LodgingBusiness' => __( '— Lodging Business', 'beeline-plugin' ),
			'BedAndBreakfast' => __( '—— Bed and Breakfast', 'beeline-plugin' ),
			'Campground'      => __( '—— Campground', 'beeline-plugin' ),
			'Hostel'          => __( '—— Hostel', 'beeline-plugin' ),
			'Hotel'           => __( '—— Hotel', 'beeline-plugin' ),
			'Motel'           => __( '—— Motel', 'beeline-plugin' ),
			'Resort'          => __( '—— Resort', 'beeline-plugin' ),

		'ProfessionalService' => __( '— Professional Service', 'beeline-plugin' ),
		'RadioStation'        => __( '— Radio Station', 'beeline-plugin' ),
		'RealEstateAgent'     => __( '— Real Estate Agent', 'beeline-plugin' ),
		'RecyclingCenter'     => __( '— Recycling Center', 'beeline-plugin' ),
		'SelfStorage'         => __( '— Self Storage', 'beeline-plugin' ),
		'ShoppingCenter'      => __( '— Shopping Center', 'beeline-plugin' ),

		// Sports Activity Locations.
		'SportsActivityLocation' => __( '— Sports Activity Location', 'beeline-plugin' ),
			'BowlingAlley'       => __( '—— Bowling Alley', 'beeline-plugin' ),
			'ExerciseGym'        => __( '—— Exercise Gym', 'beeline-plugin' ),
			'GolfCourse'         => __( '—— Golf Course', 'beeline-plugin' ),
			'HealthClub'         => __( '—— Health Club', 'beeline-plugin' ),
			'PublicSwimmingPool' => __( '—— Public Swimming Pool', 'beeline-plugin' ),
			'SkiResort'          => __( '—— Ski Resort', 'beeline-plugin' ),
			'SportsClub'         => __( '—— Sports Club', 'beeline-plugin' ),
			'StadiumOrArena'     => __( '—— Stadium or Arena', 'beeline-plugin' ),
			'TennisComplex'      => __( '—— Tennis Complex', 'beeline-plugin' ),

		// Store types.
		'Store' => __( '— Store', 'beeline-plugin' ),
			'AutoPartsStore'      => __( '—— Auto Parts Store', 'beeline-plugin' ),
			'BikeStore'           => __( '—— Bike Store', 'beeline-plugin' ),
			'BookStore'           => __( '—— Book Store', 'beeline-plugin' ),
			'ClothingStore'       => __( '—— Clothing Store', 'beeline-plugin' ),
			'ComputerStore'       => __( '—— Computer Store', 'beeline-plugin' ),
			'ConvenienceStore'    => __( '—— Convenience Store', 'beeline-plugin' ),
			'DepartmentStore'     => __( '—— Department Store', 'beeline-plugin' ),
			'ElectronicsStore'    => __( '—— Electronics Store', 'beeline-plugin' ),
			'Florist'             => __( '—— Florist', 'beeline-plugin' ),
			'FurnitureStore'      => __( '—— Furniture Store', 'beeline-plugin' ),
			'GardenStore'         => __( '—— Garden Store', 'beeline-plugin' ),
			'GroceryStore'        => __( '—— Grocery Store', 'beeline-plugin' ),
			'HardwareStore'       => __( '—— Hardware Store', 'beeline-plugin' ),
			'HobbyShop'           => __( '—— Hobby Shop', 'beeline-plugin' ),
			'HomeGoodsStore'      => __( '—— Home Goods Store', 'beeline-plugin' ),
			'JewelryStore'        => __( '—— Jewelry Store', 'beeline-plugin' ),
			'LiquorStore'         => __( '—— Liquor Store', 'beeline-plugin' ),
			'MensClothingStore'   => __( '—— Mens Clothing Store', 'beeline-plugin' ),
			'MobilePhoneStore'    => __( '—— Mobile Phone Store', 'beeline-plugin' ),
			'MovieRentalStore'    => __( '—— Movie Rental Store', 'beeline-plugin' ),
			'MusicStore'          => __( '—— Music Store', 'beeline-plugin' ),
			'OfficeEquipmentStore'=> __( '—— Office Equipment Store', 'beeline-plugin' ),
			'OutletStore'         => __( '—— Outlet Store', 'beeline-plugin' ),
			'PawnShop'            => __( '—— Pawn Shop', 'beeline-plugin' ),
			'PetStore'            => __( '—— Pet Store', 'beeline-plugin' ),
			'ShoeStore'           => __( '—— Shoe Store', 'beeline-plugin' ),
			'SportingGoodsStore'  => __( '—— Sporting Goods Store', 'beeline-plugin' ),
			'TireShop'            => __( '—— Tire Shop', 'beeline-plugin' ),
			'ToyStore'            => __( '—— Toy Store', 'beeline-plugin' ),
			'WholesaleStore'      => __( '—— Wholesale Store', 'beeline-plugin' ),

		'TelevisionStation'        => __( '— Television Station', 'beeline-plugin' ),
		'TouristInformationCenter' => __( '— Tourist Information Center', 'beeline-plugin' ),
		'TravelAgency'             => __( '— Travel Agency', 'beeline-plugin' ),

	'MedicalOrganization' => __( 'Medical Organization', 'beeline-plugin' ),
	'NGO'                 => __( 'NGO (Non-Governmental Organization', 'beeline-plugin' ),
	'PerformingGroup'     => __( 'Performing Group', 'beeline-plugin' ),
	'SportsOrganization'  => __( 'Sports Organization', 'beeline-plugin' )
];

$options = get_option( 'schema_org_type' );

$html = '<p><select id="schema_org_type" name="schema_org_type">';

foreach( $types as $type => $value ) {

	$selected = ( $options == $type ) ? 'selected="' . esc_attr( 'selected' ) . '"' : '';

	$html .= '<option value="' . esc_attr( $type ) . '" ' . $selected . '>' . esc_html( $value ) . '</option>';

}

$html .= '</select>';
$html .= sprintf(
	'<label for="schema_org_type"> %1s</label> <a href="%2s" target="_blank" class="tooltip" title="%3s"><span class="dashicons dashicons-editor-help"></span></a>',
	$args[0],
	esc_attr( esc_url( 'https://schema.org/docs/full.html#C.Organization' ) ),
	esc_attr( __( 'Read documentation for organization types', 'beeline-plugin' ) )
);
$html .= '</p>';

echo $html;
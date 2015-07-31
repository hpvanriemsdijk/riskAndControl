<?php
use App\Asset;

class AssetsTest extends TestCase {
    /** @test */
    public function get_index_json_page()
    {
        $response = $this->call('GET', 'api/assets');
        //print_r($response);
        $this->assertResponseOk();
        
    }


	/**
	 * Test a valid insertion of an Asset
	 *
	 * @return void
	 */
	public function creates_new_asset()
	{
	   // Create a new User
	   $asset = new Asset;
	   $asset->name = "Name";

	   // User should not save
	   $this->assertTrue($asset->save());

	   // Save the errors
	   // $errors = $asset->errors()->all();

	   // There should be 1 error
	   // $this->assertCount(1, $errors);

	   // The username error should be set
	   // $this->assertEquals($errors[0], "The username field is required.");
	}

}

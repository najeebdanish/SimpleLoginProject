<?php

use App\User;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Laracasts\Behat\Context\Migrator;

use Behat\Behat\Tester\Exception\PendingException;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
	
	use Migrator;
	
	protected $session;
	protected $driver;
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
		$this->driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');
        $this->session = new \Behat\Mink\Session($this->driver);        
        $this->session->start();
    }
	
	/**
	 * @Given I visit the URL of the web application
	 */
	public function iVisitTheUrlOfTheWebApplication()
	{
		$this->getSession()->visit('http://simplelogin.dev:81');
		//throw new PendingException();
	}

	/**
	 * @When I log in
	 */
	public function iLogIn()
	{
		$user = User::where('email', 'testuser@fake.com')->firstOrFail();
        Auth::login($user);
		$this->getSession()->getPage()->find('css', '[name=email]')->setValue('testuser@fake.com');
		$this
            ->getSession()
            ->getPage()
            ->find('css', '[name=password]')
            ->setValue('testuser');
		$this
            ->getSession()
            ->getPage()
            ->find('css', '[name=login]')
            ->press();
	}

	/**
	 * @Then I should see the text :arg1
	 */
	public function iShouldSeeTheText($arg1)
	{
		$this->assertSession()->pageTextContains($this->fixStepArgument($arg1));
	}
	
	/**
	* @AfterScenario
	*/
	public function tearDown()
	{
		$user = User::where('email', 'testuser@fake.com')->firstOrFail();
        Auth::logout($user);
		$this->session->stop();
	}
}

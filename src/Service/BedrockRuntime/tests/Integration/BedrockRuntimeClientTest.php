<?php

namespace AsyncAws\BedrockRuntime\Tests\Integration;

use AsyncAws\BedrockRuntime\BedrockRuntimeClient;
use AsyncAws\BedrockRuntime\Input\ConverseRequest;
use AsyncAws\BedrockRuntime\Input\InvokeModelRequest;
use AsyncAws\BedrockRuntime\ValueObject\AnyToolChoice;
use AsyncAws\BedrockRuntime\ValueObject\AutoToolChoice;
use AsyncAws\BedrockRuntime\ValueObject\ContentBlock;
use AsyncAws\BedrockRuntime\ValueObject\Document;
use AsyncAws\BedrockRuntime\ValueObject\DocumentBlock;
use AsyncAws\BedrockRuntime\ValueObject\DocumentSource;
use AsyncAws\BedrockRuntime\ValueObject\GuardrailConfiguration;
use AsyncAws\BedrockRuntime\ValueObject\GuardrailConverseContentBlock;
use AsyncAws\BedrockRuntime\ValueObject\GuardrailConverseImageBlock;
use AsyncAws\BedrockRuntime\ValueObject\GuardrailConverseImageSource;
use AsyncAws\BedrockRuntime\ValueObject\GuardrailConverseTextBlock;
use AsyncAws\BedrockRuntime\ValueObject\ImageBlock;
use AsyncAws\BedrockRuntime\ValueObject\ImageSource;
use AsyncAws\BedrockRuntime\ValueObject\InferenceConfiguration;
use AsyncAws\BedrockRuntime\ValueObject\Message;
use AsyncAws\BedrockRuntime\ValueObject\PerformanceConfiguration;
use AsyncAws\BedrockRuntime\ValueObject\PromptVariableValues;
use AsyncAws\BedrockRuntime\ValueObject\ReasoningContentBlock;
use AsyncAws\BedrockRuntime\ValueObject\ReasoningTextBlock;
use AsyncAws\BedrockRuntime\ValueObject\S3Location;
use AsyncAws\BedrockRuntime\ValueObject\SpecificToolChoice;
use AsyncAws\BedrockRuntime\ValueObject\SystemContentBlock;
use AsyncAws\BedrockRuntime\ValueObject\Tool;
use AsyncAws\BedrockRuntime\ValueObject\ToolChoice;
use AsyncAws\BedrockRuntime\ValueObject\ToolConfiguration;
use AsyncAws\BedrockRuntime\ValueObject\ToolInputSchema;
use AsyncAws\BedrockRuntime\ValueObject\ToolResultBlock;
use AsyncAws\BedrockRuntime\ValueObject\ToolResultContentBlock;
use AsyncAws\BedrockRuntime\ValueObject\ToolSpecification;
use AsyncAws\BedrockRuntime\ValueObject\ToolUseBlock;
use AsyncAws\BedrockRuntime\ValueObject\VideoBlock;
use AsyncAws\BedrockRuntime\ValueObject\VideoSource;
use AsyncAws\Core\Credentials\NullProvider;
use AsyncAws\Core\Test\TestCase;

class BedrockRuntimeClientTest extends TestCase
{
    public function testConverse(): void
    {
        $client = $this->getClient();

        $input = new ConverseRequest([
            'modelId' => 'change me',
            'messages' => [new Message([
                'role' => 'change me',
                'content' => [new ContentBlock([
                    'text' => 'change me',
                    'image' => new ImageBlock([
                        'format' => 'change me',
                        'source' => new ImageSource([
                            'bytes' => 'change me',
                        ]),
                    ]),
                    'document' => new DocumentBlock([
                        'format' => 'change me',
                        'name' => 'change me',
                        'source' => new DocumentSource([
                            'bytes' => 'change me',
                        ]),
                    ]),
                    'video' => new VideoBlock([
                        'format' => 'change me',
                        'source' => new VideoSource([
                            'bytes' => 'change me',
                            's3Location' => new S3Location([
                                'uri' => 'change me',
                                'bucketOwner' => 'change me',
                            ]),
                        ]),
                    ]),
                    'toolUse' => new ToolUseBlock([
                        'toolUseId' => 'change me',
                        'name' => 'change me',
                        'input' => new Document([
                        ]),
                    ]),
                    'toolResult' => new ToolResultBlock([
                        'toolUseId' => 'change me',
                        'content' => [new ToolResultContentBlock([
                            'json' => new Document([
                            ]),
                            'text' => 'change me',
                            'image' => new ImageBlock([
                                'format' => 'change me',
                                'source' => new ImageSource([
                                    'bytes' => 'change me',
                                ]),
                            ]),
                            'document' => new DocumentBlock([
                                'format' => 'change me',
                                'name' => 'change me',
                                'source' => new DocumentSource([
                                    'bytes' => 'change me',
                                ]),
                            ]),
                            'video' => new VideoBlock([
                                'format' => 'change me',
                                'source' => new VideoSource([
                                    'bytes' => 'change me',
                                    's3Location' => new S3Location([
                                        'uri' => 'change me',
                                        'bucketOwner' => 'change me',
                                    ]),
                                ]),
                            ]),
                        ])],
                        'status' => 'change me',
                    ]),
                    'guardContent' => new GuardrailConverseContentBlock([
                        'text' => new GuardrailConverseTextBlock([
                            'text' => 'change me',
                            'qualifiers' => ['change me'],
                        ]),
                        'image' => new GuardrailConverseImageBlock([
                            'format' => 'change me',
                            'source' => new GuardrailConverseImageSource([
                                'bytes' => 'change me',
                            ]),
                        ]),
                    ]),
                    'reasoningContent' => new ReasoningContentBlock([
                        'reasoningText' => new ReasoningTextBlock([
                            'text' => 'change me',
                            'signature' => 'change me',
                        ]),
                        'redactedContent' => 'change me',
                    ]),
                ])],
            ])],
            'system' => [new SystemContentBlock([
                'text' => 'change me',
                'guardContent' => new GuardrailConverseContentBlock([
                    'text' => new GuardrailConverseTextBlock([
                        'text' => 'change me',
                        'qualifiers' => ['change me'],
                    ]),
                    'image' => new GuardrailConverseImageBlock([
                        'format' => 'change me',
                        'source' => new GuardrailConverseImageSource([
                            'bytes' => 'change me',
                        ]),
                    ]),
                ]),
            ])],
            'inferenceConfig' => new InferenceConfiguration([
                'maxTokens' => 1337,
                'temperature' => 1337,
                'topP' => 1337,
                'stopSequences' => ['change me'],
            ]),
            'toolConfig' => new ToolConfiguration([
                'tools' => [new Tool([
                    'toolSpec' => new ToolSpecification([
                        'name' => 'change me',
                        'description' => 'change me',
                        'inputSchema' => new ToolInputSchema([
                            'json' => new Document([
                            ]),
                        ]),
                    ]),
                ])],
                'toolChoice' => new ToolChoice([
                    'auto' => new AutoToolChoice([
                    ]),
                    'any' => new AnyToolChoice([
                    ]),
                    'tool' => new SpecificToolChoice([
                        'name' => 'change me',
                    ]),
                ]),
            ]),
            'guardrailConfig' => new GuardrailConfiguration([
                'guardrailIdentifier' => 'change me',
                'guardrailVersion' => 'change me',
                'trace' => 'change me',
            ]),
            'additionalModelRequestFields' => new Document([
            ]),
            'promptVariables' => ['change me' => new PromptVariableValues([
                'text' => 'change me',
            ])],
            'additionalModelResponseFieldPaths' => ['change me'],
            'requestMetadata' => ['change me' => 'change me'],
            'performanceConfig' => new PerformanceConfiguration([
                'latency' => 'change me',
            ]),
        ]);
        $result = $client->converse($input);

        $result->resolve();

        // self::assertTODO(expected, $result->getOutput());
        self::assertSame('changeIt', $result->getStopReason());
        // self::assertTODO(expected, $result->getUsage());
        // self::assertTODO(expected, $result->getMetrics());
        // self::assertTODO(expected, $result->getAdditionalModelResponseFields());
        // self::assertTODO(expected, $result->getTrace());
        // self::assertTODO(expected, $result->getPerformanceConfig());
    }

    public function testInvokeModel(): void
    {
        $client = $this->getClient();

        $input = new InvokeModelRequest([
            'body' => 'change me',
            'contentType' => 'change me',
            'accept' => 'change me',
            'modelId' => 'change me',
            'trace' => 'change me',
            'guardrailIdentifier' => 'change me',
            'guardrailVersion' => 'change me',
            'performanceConfigLatency' => 'change me',
        ]);
        $result = $client->invokeModel($input);

        $result->resolve();

        // self::assertTODO(expected, $result->getBody());
        self::assertSame('changeIt', $result->getContentType());
        self::assertSame('changeIt', $result->getPerformanceConfigLatency());
    }

    private function getClient(): BedrockRuntimeClient
    {
        self::markTestSkipped('There is no docker image available for BedrockRuntime.');

        return new BedrockRuntimeClient([
            'endpoint' => 'http://localhost',
        ], new NullProvider());
    }
}
